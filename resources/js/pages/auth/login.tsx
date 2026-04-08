import { SignIn } from "@clerk/clerk-react";
import { Head } from "@inertiajs/react";

export default function Login() {
    return (
        <div className="flex min-h-screen items-center justify-center bg-[#050505]">
            <Head title="Login — E-Library" />

            {/*
             * fallbackRedirectUrl: setelah login Clerk → ke /auth/clerk/callback
             * Callback page akan ambil token dan buat Laravel session,
             * lalu redirect ke /beranda
             */}
            <SignIn
                routing="path"
                path="/login"
                signUpUrl="/register"
                fallbackRedirectUrl="/auth/clerk/callback"
                appearance={{
                    variables: {
                        colorBackground:     '#0a0a0a',
                        colorText:           '#ffffff',
                        colorPrimary:        '#6366f1',
                        colorInputBackground: 'rgba(255,255,255,0.03)',
                        colorInputText:      '#ffffff',
                        borderRadius:        '16px',
                        fontFamily:          'Plus Jakarta Sans, sans-serif',
                    },
                    elements: {
                        card:           'shadow-none bg-transparent border border-white/5 backdrop-blur-xl',
                        headerTitle:    'text-white font-black',
                        headerSubtitle: 'text-white/40',
                        socialButtonsBlockButton: 'border-white/10 bg-white/5 hover:bg-white/10 text-white',
                        formFieldInput: 'bg-white/5 border-white/10 text-white',
                        footerActionLink: 'text-indigo-400 hover:text-white',
                    },
                }}
            />
        </div>
    );
}