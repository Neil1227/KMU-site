
document.getElementById("contactForm").addEventListener("submit", async function(e) {
  e.preventDefault(); // stop normal form submission

  const form = e.target;
  const status = document.getElementById("formStatus");
  const formData = new FormData(form);

  try {
    const response = await fetch("https://formspree.io/f/xzzvwzyn", {
      method: "POST",
      body: formData,
      headers: { 'Accept': 'application/json' }
    });

    if (response.ok) {
      status.innerHTML = `<div class="alert alert-success">✅ Your message has been sent successfully!</div>`;
      form.reset();
    } else {
      status.innerHTML = `<div class="alert alert-danger">❌ Oops! Something went wrong. Please try again.</div>`;
    }
  } catch (error) {
    status.innerHTML = `<div class="alert alert-danger">❌ Network error. Please check your connection.</div>`;
  }
});

