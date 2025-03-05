import { writable, readable, derived } from 'svelte/store';

// Writable store for theme
export const theme = writable('light');

// Readable store for time
export const time = readable(new Date(), function start(set) {
    const interval = setInterval(() => {
        set(new Date());
    }, 1000);

    return function stop() {
        clearInterval(interval);
    };
});

// Writable store for cart items
export const cart = writable([]);

// Derived store for cart total
export const cartTotal = derived(cart, $cart => 
    $cart.reduce((total, item) => total + item.price * item.quantity, 0)
); 