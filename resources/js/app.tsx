import '../css/app.css';

import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ClerkProvider } from '@clerk/clerk-react'; // <-- Impor Clerk

// Ambil Key dari .env
const PUBLISHABLE_KEY = import.meta.env.VITE_CLERK_PUBLISHABLE_KEY;

if (!PUBLISHABLE_KEY) {
    throw new Error("Missing Publishable Key. Cek file .env kamu, Prinz!");
}

createInertiaApp({
    title: (title) => `${title} - E-Library`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.tsx`, import.meta.glob('./pages/**/*.tsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(
            <ClerkProvider publishableKey={PUBLISHABLE_KEY}>
                <App {...props} />
            </ClerkProvider>
        );
    },
    progress: {
        color: '#4B5563',
    },
});