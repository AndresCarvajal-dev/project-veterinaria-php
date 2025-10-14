<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Sistema de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slideUp {
            animation: slideUp 0.4s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Card principal -->
        <div class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-3xl p-8 animate-fadeIn">
            
            <!-- Header con icono -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Crear Cuenta
                </h2>
                <p class="text-gray-500 text-sm mt-2">Regístrate para comenzar a gestionar productos</p>
            </div>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-lg flex items-start gap-3 animate-slideUp">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-lg animate-slideUp">
                    <div class="flex items-start gap-3 mb-2">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-semibold">Por favor corrige los siguientes errores:</span>
                    </div>
                    <ul class="ml-8 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                @csrf

                <!-- Nombre completo -->
                <div class="group">
                    <label for="fullname" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nombre completo
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="fullname" 
                            id="fullname" 
                            value="{{ old('fullname') }}"
                            required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all duration-200 hover:border-gray-400 @error('fullname') border-red-300 @enderror"
                            placeholder="Juan Pérez"
                        >
                    </div>
                    @error('fullname')
                        <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Correo electrónico
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all duration-200 hover:border-gray-400 @error('email') border-red-300 @enderror"
                            placeholder="tu@email.com"
                        >
                    </div>
                    @error('email')
                        <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="group">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all duration-200 hover:border-gray-400 @error('password') border-red-300 @enderror"
                            placeholder="Mínimo 8 caracteres"
                        >
                    </div>
                    @error('password')
                        <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1 ml-1">Usa al menos 8 caracteres con letras y números</p>
                </div>

                <!-- Confirmar Password -->
                <div class="group">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        Confirmar contraseña
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all duration-200 hover:border-gray-400"
                            placeholder="Confirmar contraseña"
                        >
                    </div>
                </div>

                <!-- Botón de submit -->
                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 mt-6"
                >
                    Crear Cuenta
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">¿Ya tienes cuenta?</span>
                    </div>
                </div>

                <!-- Link a login -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-purple-600 font-semibold text-sm transition-colors duration-200">
                        Inicia sesión aquí
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-600 text-xs mt-6">
            © {{ date('Y') }} Sistema de Productos. Todos los derechos reservados.
        </p>
    </div>

</body>
</html>
