# Counter.svelte
<script>
    // Reactive variable
    let count = 0;

    // Reactive declaration
    $: doubled = count * 2;

    // Methods
    function increment() {
        count += 1;
    }

    function decrement() {
        count -= 1;
    }

    function reset() {
        count = 0;
    }
</script>

<div class="counter">
    <h2>Counter Example</h2>
    
    <div class="display">
        <p>Count: {count}</p>
        <p>Doubled: {doubled}</p>
    </div>

    <div class="buttons">
        <button on:click={decrement}>-</button>
        <button on:click={reset}>Reset</button>
        <button on:click={increment}>+</button>
    </div>
</div>

<style>
    .counter {
        max-width: 300px;
        margin: 2rem auto;
        padding: 1rem;
        border: 2px solid #ccc;
        border-radius: 8px;
        text-align: center;
    }

    .display {
        margin: 1rem 0;
        font-size: 1.2rem;
    }

    .buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    button {
        padding: 0.5rem 1rem;
        font-size: 1.2rem;
        border: none;
        border-radius: 4px;
        background: #4CAF50;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
    }

    button:hover {
        background: #45a049;
    }
</style> 