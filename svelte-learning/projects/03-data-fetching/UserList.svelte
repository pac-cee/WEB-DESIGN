<script>
    import { onMount } from 'svelte';

    let users = [];
    let loading = true;
    let error = null;

    async function fetchUsers() {
        try {
            const response = await fetch('https://jsonplaceholder.typicode.com/users');
            if (!response.ok) throw new Error('Failed to fetch users');
            users = await response.json();
        } catch (e) {
            error = e.message;
        } finally {
            loading = false;
        }
    }

    onMount(fetchUsers);
</script>

<div class="user-list">
    <h2>User List Example</h2>

    {#if loading}
        <div class="loading">Loading users...</div>
    {:else if error}
        <div class="error">Error: {error}</div>
    {:else}
        <div class="users">
            {#each users as user (user.id)}
                <div class="user-card">
                    <h3>{user.name}</h3>
                    <p><strong>Email:</strong> {user.email}</p>
                    <p><strong>Company:</strong> {user.company.name}</p>
                </div>
            {/each}
        </div>
    {/if}
</div>

<style>
    .user-list {
        max-width: 800px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .loading {
        text-align: center;
        padding: 2rem;
        font-size: 1.2rem;
        color: #666;
    }

    .error {
        text-align: center;
        padding: 1rem;
        background: #ffebee;
        color: #c62828;
        border-radius: 4px;
    }

    .users {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
        padding: 1rem 0;
    }

    .user-card {
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .user-card h3 {
        margin: 0 0 0.5rem 0;
        color: #2196F3;
    }

    .user-card p {
        margin: 0.5rem 0;
        font-size: 0.9rem;
    }
</style> 