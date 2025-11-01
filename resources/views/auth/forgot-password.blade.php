<x-layout>
<div class="min-h-[calc(100vh-0px)] flex flex-col md:flex-row">
    <!-- LEFT: Forgot Password form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
      <div class="w-full max-w-md h-full md:h-auto bg-white/5 backdrop-blur-sm rounded-2xl shadow-lg p-8 md:p-10 flex flex-col justify-center">
        <header class="mb-6">
          <h1 class="text-3xl font-bold tracking-tight">Forgot password?</h1>
          <p class="text-sm mt-1 text-[--muted]">Enter your email to receive a reset link</p>
        </header>

        @if(session('success'))
          <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20">
            <p class="text-sm text-green-400">{{ session('success') }}</p>
          </div>
        @endif


        <form action="{{ route('password.email') }}" method="POST" class="space-y-5" novalidate>
          @csrf

          <div>
            <label for="email" class="block text-sm font-medium mb-2">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
              class="block w-full rounded-xl border border-[var(--muted)] bg-white/6 px-4 py-3 placeholder:text-[var(--muted)] focus:outline-none focus:ring-2 focus:ring-[var(--accent)] focus:border-transparent" 
              placeholder="you@Nexus.com" />
          </div>

          <div>
            <button type="submit"
              class="w-full rounded-xl py-3 font-semibold text-[var(--nav-bg)] bg-[var(--accent)] hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-[var(--link-hover)]">
              Send Reset Link
            </button>
          </div>

          <div class="text-center text-sm text-[--muted]">
            Remember your password?
            <a href="{{ route('show.login') }}" class="nav-link">Back to login</a>
          </div>

          @if($errors->any())
            <div class="mt-4">
              <ul class="list-disc list-inside text-sm text-red-600">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </form>
      </div>
    </div>

    <!-- RIGHT: Decorative panel -->
    <aside class="hidden md:flex md:w-1/2 items-center justify-center p-8"
      style="background: transparent;">
      <div class="w-full h-full rounded-2xl flex flex-col items-center justify-center">
        <div class="select-none" style="color: var(--accentlight);">
          made by NexusSphere
        </div>
        <div class="text-7xl font-extrabold select-none" style="color: var(--accent);">
          LabCore
        </div>
      </div>
    </aside>
  </div>
</x-layout>