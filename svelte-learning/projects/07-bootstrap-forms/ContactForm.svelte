<script>
  import 'bootstrap/dist/css/bootstrap.min.css';
  import { onMount } from 'svelte';

  let formData = {
    name: '',
    email: '',
    subject: '',
    message: ''
  };

  let submitted = false;
  let loading = false;

  onMount(() => {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });

  async function handleSubmit() {
    loading = true;
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000));
    submitted = true;
    loading = false;
  }
</script>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Contact Us</h2>
          
          {#if submitted}
            <div class="alert alert-success" role="alert">
              Thank you for your message! We'll get back to you soon.
            </div>
          {:else}
            <form on:submit|preventDefault={handleSubmit}>
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  bind:value={formData.name}
                  required
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Please enter your full name"
                >
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  bind:value={formData.email}
                  required
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Enter your email address"
                >
              </div>

              <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input
                  type="text"
                  class="form-control"
                  id="subject"
                  bind:value={formData.subject}
                  required
                >
              </div>

              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea
                  class="form-control"
                  id="message"
                  rows="5"
                  bind:value={formData.message}
                  required
                ></textarea>
              </div>

              <div class="d-grid">
                <button
                  type="submit"
                  class="btn btn-primary"
                  disabled={loading}
                >
                  {#if loading}
                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                    Sending...
                  {:else}
                    Send Message
                  {/if}
                </button>
              </div>
            </form>
          {/if}
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  /* Add any custom styles here */
  :global(body) {
    background-color: #f8f9fa;
  }
</style> 