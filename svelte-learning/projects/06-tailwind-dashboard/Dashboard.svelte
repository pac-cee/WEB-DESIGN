{/* Add Tailwind base styles */}
<style lang="postcss">
  @tailwind base;
  @tailwind components;
  @tailwind utilities;
</style>

<script>
  let stats = [
    { title: 'Total Users', value: '1,234', change: '+12%', icon: '👥' },
    { title: 'Revenue', value: '$12,345', change: '+8%', icon: '💰' },
    { title: 'Active Projects', value: '45', change: '+5%', icon: '📊' },
    { title: 'Conversion Rate', value: '3.2%', change: '+2%', icon: '📈' }
  ];
</script>

<div class="min-h-screen bg-gray-100">
  {/* Navigation */}
  <nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <h1 class="text-xl font-bold text-gray-800">Tailwind Dashboard</h1>
        </div>
      </div>
    </div>
  </nav>

  {/* Main Content */}
  <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    {/* Stats Grid */}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
      {#each stats as stat}
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <span class="text-2xl">{stat.icon}</span>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">
                    {stat.title}
                  </dt>
                  <dd class="flex items-baseline">
                    <div class="text-2xl font-semibold text-gray-900">
                      {stat.value}
                    </div>
                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                      {stat.change}
                    </div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      {/each}
    </div>

    {/* Chart Section */}
    <div class="mt-8 bg-white shadow rounded-lg">
      <div class="p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Analytics Overview
        </h3>
        <div class="mt-4 h-64 bg-gray-50 rounded-lg border border-gray-200 p-4">
          <p class="text-center text-gray-500">Chart placeholder</p>
        </div>
      </div>
    </div>
  </main>
</div> 