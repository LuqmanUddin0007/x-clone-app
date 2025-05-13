const apiUrl = '/api';
const token = localStorage.getItem('apiToken');
if (!token) window.location.href = '/';

const nameEl = document.getElementById('dashboardName');
const emailEl = document.getElementById('dashboardEmail');
const avatarEl = document.getElementById('dashboardAvatar');
const logoutBtn = document.getElementById('logoutBtn');
const btnCreatePost = document.getElementById('btnCreatePost');
const postForm = document.getElementById('postForm');
const postContent = document.getElementById('postContent');
const postsList = document.getElementById('postsList');
const postFormSection = document.getElementById('postFormSection');

async function loadDashboard() {
  const res = await fetch(`${apiUrl}/profile`, {
    headers: { Authorization: `Bearer ${token}` }
  });
  const json = await res.json();
  nameEl.textContent = json.user.name;
  emailEl.textContent = json.user.email;
  avatarEl.src = json.user.profile_picture ? `/storage/${json.user.profile_picture}` : 'https://via.placeholder.com/100';
}

async function loadPosts() {
  const res = await fetch(`${apiUrl}/users/posts`, {
    headers: { Authorization: `Bearer ${token}` }
  });
const json = await res.json();

  const posts = Array.isArray(json) ? json : json.data || [];

  console.log(posts);
  postsList.innerHTML = '';
  posts.forEach(post => {
    const li = document.createElement('li');
    li.className = 'list-group-item';
    li.innerHTML = `<p>${post.content}</p><small>${new Date(post.updated_at).toLocaleString()}</small>`;
    postsList.appendChild(li);
  });
}

logoutBtn.addEventListener('click', async () => {
  await fetch(`${apiUrl}/logout`, {
    method: 'POST',
    headers: { Authorization: `Bearer ${token}` }
  });
  localStorage.removeItem('apiToken');
  window.location.href = '/';
});

btnCreatePost.addEventListener('click', () => {
  postFormSection.classList.toggle('d-none');
});

postForm.addEventListener('submit', async e => {
  e.preventDefault();
  const data = { content: postContent.value };
  const res = await fetch(`${apiUrl}/posts`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  });
  if (res.ok) {
    postForm.reset();
    loadPosts();
  }
});

loadDashboard();
loadPosts();
