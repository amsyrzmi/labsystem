<x-layout>
<div class="min-h-[calc(100vh-0px)] flex flex-col md:flex-row">
    <!-- LEFT: Login form (full height/width of left column) -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
      <div class="w-full max-w-md h-full md:h-auto bg-white/5 backdrop-blur-sm rounded-2xl shadow-lg p-8 md:p-10 flex flex-col justify-center">
        <header class="mb-6">
          <h1 class="text-3xl font-bold tracking-tight">Welcome back</h1>
          <p class="text-sm mt-1 text-[--muted]">Sign in to your LabCore account</p>
        </header>

        <form action="{{ route('login') }}" method="POST" class="space-y-5" novalidate>
          @csrf

          <div>
            <label for="email" class="block text-sm font-medium mb-2">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent" 
              placeholder="you@Nexus.com" />
          </div>

          <div>
            <label for="password" class="block text-sm font-medium mb-2">Password</label>
            <input id="password" name="password" type="password" required
              class="block w-full rounded-xl border border-transparent bg-white/6 px-4 py-3 placeholder:text-[--muted] focus:outline-none focus:ring-2 focus:ring-[--accent] focus:border-transparent"
              placeholder="••••••••" />
          </div>

          <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center gap-2">
              <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 bg-white/5" />
              <span>Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-sm nav-link">Forgot password?</a>
          </div>

          <div>
            <button type="submit"
              class="w-full rounded-xl py-3 font-semibold text-[--nav-bg] bg-[--accent] hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-[--link-hover]">
              Sign in
            </button>
          </div>

          <div class="text-center text-sm text-[--muted]">
            Don't have an account?
            <a href="{{ route('show.register') }}" class="nav-link">Create one</a>
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

    <!-- RIGHT: Decorative panel (hidden on small screens) -->
    <aside class="hidden md:flex md:w-1/2 items-center justify-center p-8"
      style="background: transparent;">
      <!-- full-height card look -->
      <div class="w-full h-full rounded-2xl flex flex-col items-center justify-center">
        <!-- Large decorative text — low opacity to be subtle -->
        <div class=" select-none" style="color: white;">
          made by NexusSphere
        </div>
        <div class="text-7xl font-extrabold select-none" style="color: white;">
          LabCore
        </div>
      </div>
    </aside>
  </div>

</x-layout>