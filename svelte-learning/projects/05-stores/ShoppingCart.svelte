<script>
    import { cart, cartTotal, theme } from './stores.js';

    let newItem = { name: '', price: 0, quantity: 1 };

    function addToCart() {
        if (newItem.name && newItem.price > 0) {
            cart.update(items => [...items, { ...newItem }]);
            newItem = { name: '', price: 0, quantity: 1 };
        }
    }

    function removeItem(index) {
        cart.update(items => items.filter((_, i) => i !== index));
    }

    function toggleTheme() {
        theme.update(t => t === 'light' ? 'dark' : 'light');
    }
</script>

<div class="shopping-cart" class:dark={$theme === 'dark'}>
    <h2>Shopping Cart Example</h2>
    
    <button class="theme-toggle" on:click={toggleTheme}>
        Toggle Theme
    </button>

    <div class="add-item">
        <input 
            type="text" 
            bind:value={newItem.name} 
            placeholder="Item name"
        >
        <input 
            type="number" 
            bind:value={newItem.price} 
            placeholder="Price"
            min="0"
            step="0.01"
        >
        <input 
            type="number" 
            bind:value={newItem.quantity} 
            placeholder="Quantity"
            min="1"
        >
        <button on:click={addToCart}>Add to Cart</button>
    </div>

    <div class="cart-items">
        {#if $cart.length === 0}
            <p>Cart is empty</p>
        {:else}
            {#each $cart as item, i}
                <div class="cart-item">
                    <span>{item.name}</span>
                    <span>${item.price} × {item.quantity}</span>
                    <button on:click={() => removeItem(i)}>Remove</button>
                </div>
            {/each}
            <div class="cart-total">
                Total: ${$cartTotal.toFixed(2)}
            </div>
        {/if}
    </div>
</div>

<style>
    .shopping-cart {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        border-radius: 8px;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .dark {
        background: #333;
        color: white;
    }

    .add-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 0.5rem;
        margin: 1rem 0;
    }

    input {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        background: #4CAF50;
        color: white;
        cursor: pointer;
    }

    .theme-toggle {
        background: #2196F3;
        margin-bottom: 1rem;
    }

    .cart-items {
        margin-top: 2rem;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem;
        border-bottom: 1px solid #ddd;
    }

    .cart-total {
        margin-top: 1rem;
        text-align: right;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .dark input {
        background: #444;
        color: white;
        border-color: #555;
    }

    .dark .cart-item {
        border-color: #555;
    }
</style> 