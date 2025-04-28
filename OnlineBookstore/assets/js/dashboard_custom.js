// Dashboard JS for Features & Theme
// Theme toggle
const themeBtn = document.getElementById('theme-btn');
const themeIcon = document.getElementById('theme-icon');
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
function setTheme(theme) {
    document.documentElement.classList.toggle('dark', theme === 'dark');
    localStorage.setItem('theme', theme);
    themeIcon.textContent = theme === 'dark' ? '🌙' : (theme === 'light' ? '🌞' : '🌗');
}
function getTheme() {
    return localStorage.getItem('theme') || 'system';
}
function applyTheme() {
    const theme = getTheme();
    if (theme === 'dark') setTheme('dark');
    else if (theme === 'light') setTheme('light');
    else setTheme(prefersDark ? 'dark' : 'light');
}
themeBtn.onclick = function() {
    const current = getTheme();
    if (current === 'light') setTheme('dark');
    else if (current === 'dark') setTheme('system');
    else setTheme('light');
};
applyTheme();
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyTheme);

// Profile dropdown
const profileBtn = document.getElementById('profileBtn');
const profileMenu = document.getElementById('profileMenu');
if(profileBtn && profileMenu){
    profileBtn.onclick = (e) => {
        e.stopPropagation();
        profileMenu.parentElement.classList.toggle('open');
    };
    document.addEventListener('click', () => profileMenu.parentElement.classList.remove('open'));
}

// Dummy Data for Activity, Notifications, Recommendations
const activityFeed = document.getElementById('activity-feed');
const notificationsFeed = document.getElementById('notifications-feed');
const recommendationsList = document.getElementById('recommendations-list');
if(activityFeed){
    activityFeed.innerHTML = [
        '<li><i class="fas fa-shopping-cart"></i> Ordered: "The Great Gatsby"</li>',
        '<li><i class="fas fa-question-circle"></i> Completed quiz: "1984 Quiz"</li>',
        '<li><i class="fas fa-book-open"></i> Browsed new arrivals</li>'
    ].join('');
}
if(notificationsFeed){
    notificationsFeed.innerHTML = [
        '<li><i class="fas fa-bell"></i> New quiz available: "To Kill a Mockingbird Quiz"</li>',
        '<li><i class="fas fa-bell"></i> Order shipped: "1984"</li>'
    ].join('');
}
if(recommendationsList){
    recommendationsList.innerHTML = [
        '<li><i class="fas fa-star"></i> "Brave New World" - Recommended for you</li>',
        '<li><i class="fas fa-star"></i> "Animal Farm" - Based on your quiz interests</li>'
    ].join('');
}
// Stats Graph (using Chart.js CDN)
const statsChart = document.getElementById('statsChart');
if(statsChart){
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
    script.onload = () => {
        new Chart(statsChart.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Quizzes', 'Orders', 'Books'],
                datasets: [{
                    label: 'Last 6 Months',
                    data: [3, 1, 3],
                    backgroundColor: ['#6c63ff','#2a5298','#ffb300']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    };
    document.head.appendChild(script);
}
