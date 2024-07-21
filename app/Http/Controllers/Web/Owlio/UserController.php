<?php

namespace App\Http\Controllers\Web\Owlio;

use App\Enums\MemberLevel;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\SettingRepository;
use App\Repositories\WalletChangeLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private SettingRepository $settingRepository;
    private WalletChangeLogRepository $walletChangeLogRepository;

    public function __construct(SettingRepository $settingRepository, WalletChangeLogRepository $walletChangeLogRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->walletChangeLogRepository = $walletChangeLogRepository;
    }

    public function index(Request $request)
    {
        $users = User::paginate(15);
        // dd($users);
        return view('themes.owlio.list_users', [
            'users' => $users,
        ]);
    }

    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('themes.owlio.login');
        }
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (
            Auth::attempt([
                'username' => $request->username,
                'password' => $request->password,
            ]) || Auth::attempt([
                'email' => $request->username,
                'password' => $request->password,
            ])
        ) {
            $request->session()->regenerate();
            if ($request->redirectTo) {
                return redirect($request->redirectTo);
            }
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('themes.owlio.register');
        }

        $rules = [
            "username" => "required|unique:users,username",
            "password" => "required",
            "name" => "required",
            "email" => "required|unique:users,email",
            "phone" => "required|unique:users,phone"
        ];
        $message = [
            'username.unique' => 'Tài khoản này đã được sử dụng!',
            'email.unique' => 'Email này đã được sử dụng!',
            'phone.unique' => 'Số điện thoại này đã được sử dụng!'
        ];
        $data = $request->validate($rules, $message);
        $data['password'] = Hash::make($request->password);
        $data['level'] = MemberLevel::MEMBER;

        DB::table('users')->insert($data);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, hãy đăng nhập để tiếp tục');
    }

    public function deposit(Request $request)
    {
        $setting = $this->settingRepository->getFirst();

        if ($request->isMethod('GET')) {
            return view('themes.owlio.deposit', compact('setting'));
        }
    }

    public function walletHistory(Request $request)
    {
        $request['user_id'] = Auth::id();

        $walletChanges = $this->walletChangeLogRepository->getPaginate($request, null);

        return view('themes.owlio.wallet_change', compact('walletChanges'));
    }

    public function setTimezone(Request $request)
    {
        $request->validate([
            'timezone' => 'required|string',
        ]);

        // Lưu múi giờ vào session
        Session::put('current_time_zone', $request->timezone);

        return response()->json(['success' => true]);
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod('GET')) {
            return view('themes.owlio.profile', compact('user'));
        }
    }

    public function createToken()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $tokenResult]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [],
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore(auth()->id()),
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ]
        ], [
            'username.unique' => 'Tài khoản đã được sử dụng',
            'email.unique' => 'Email đã được sử dụng'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $update = $validator->validated();
        if ($request->change_password) {
            $update['password'] = Hash::make($request->change_password);
        }

        $this->userRepository->update(auth()->id(), $update);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
