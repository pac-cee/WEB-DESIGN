<script>
    import Counter from '../projects/01-basics/Counter.svelte';
    import UserList from '../projects/03-data-fetching/UserList.svelte';
    import ShoppingCart from '../projects/05-stores/ShoppingCart.svelte';
</script>

<main>
    <h1>Svelte Learning Projects</h1>
    
    <section>
        <Counter />
    </section>

    <section>
        <UserList />
    </section>

    <section>
        <ShoppingCart />
    </section>
</main>

<style>
    main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    h1 {
        color: #2196F3;
        text-align: center;
        margin-bottom: 2rem;
    }

    section {
        margin-bottom: 3rem;
        padding: 1rem;
        border-radius: 8px;
        background: #f5f5f5;
    }
</style> 