import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Inicializar Echo con socket.io usando imports ES modules (Vite)
import Echo from 'laravel-echo';
import { io } from 'socket.io-client';

// Exponer io/global por si alguna librería lo espera
window.io = io;

// Configura el host/puerto donde escucha tu servidor de websockets
const websocketHost = `${window.location.hostname}:6001`;

// Crear instancia de Echo
window.Echo = new Echo({
    broadcaster: 'socket.io',
    client: io,
    host: `${window.location.protocol === 'https:' ? 'https' : 'http'}://${websocketHost}`,
    transports: ['websocket', 'polling'],
});

// Añadir logs y manejadores para depurar la conexión
const attachSocketHandlers = () => {
    try {
        const socket = window.Echo && window.Echo.connector && window.Echo.connector.socket;
        if (!socket) {
            console.warn('Echo socket no está disponible aún. Intentando de nuevo en 500ms...');
            setTimeout(attachSocketHandlers, 500);
            return;
        }

        socket.on('connect', () => {
            console.info('Echo conectado (socket.io). id=', socket.id);
        });

        socket.on('connect_error', (err) => {
            console.error('Echo connect_error:', err);
        });

        socket.on('error', (err) => {
            console.error('Echo socket error:', err);
        });

        socket.on('disconnect', (reason) => {
            console.warn('Echo desconectado:', reason);
        });
    } catch (e) {
        console.error('Error al adjuntar handlers de Echo:', e);
    }
};

attachSocketHandlers();
