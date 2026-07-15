(() => {
  'use strict';

  const $ = (selector, root = document) => root.querySelector(selector);
  const $$ = (selector, root = document) => [...root.querySelectorAll(selector)];

  function initialiseIcons() {
    if (window.lucide?.createIcons) window.lucide.createIcons();
  }

  function initialiseMobileMenu() {
    const toggle = $('#menu-toggle');
    const menu = $('#mobile-menu');
    if (!toggle || !menu) return;

    const setOpen = (open) => {
      menu.hidden = !open;
      toggle.setAttribute('aria-expanded', String(open));
      const icon = toggle.querySelector('[data-lucide]');
      if (icon) icon.setAttribute('data-lucide', open ? 'x' : 'menu');
      initialiseIcons();
    };

    toggle.addEventListener('click', () => setOpen(menu.hidden));
    $$('.mobile-menu-link', menu).forEach((link) => link.addEventListener('click', () => setOpen(false)));
    window.addEventListener('resize', () => {
      if (window.innerWidth > 900) setOpen(false);
    });
  }

  function initialiseRotatingWord() {
    const word = $('#rotating-word');
    if (!word) return;

    let words;
    try { words = JSON.parse(word.dataset.words || '[]'); }
    catch { words = []; }
    if (words.length < 2 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    let index = 0;
    window.setInterval(() => {
      word.classList.add('is-changing');
      window.setTimeout(() => {
        index = (index + 1) % words.length;
        word.textContent = words[index];
        word.classList.remove('is-changing');
      }, 220);
    }, 2600);
  }

  function initialiseCountdowns() {
    const countdowns = $$('.countdown');
    if (!countdowns.length) return;

    const update = () => {
      countdowns.forEach((countdown) => {
        const target = new Date(countdown.dataset.deadline).getTime();
        const remaining = Math.max(0, target - Date.now());
        const values = {
          days: Math.floor(remaining / 86400000),
          hours: Math.floor((remaining % 86400000) / 3600000),
          minutes: Math.floor((remaining % 3600000) / 60000),
          seconds: Math.floor((remaining % 60000) / 1000),
        };
        Object.entries(values).forEach(([key, value]) => {
          const output = countdown.querySelector(`[data-countdown="${key}"]`);
          if (output) output.textContent = String(value).padStart(2, '0');
        });
      });
    };

    update();
    window.setInterval(update, 1000);
  }

  function initialiseFaqs() {
    const questions = $$('.faq-question');
    questions.forEach((question) => {
      question.addEventListener('click', () => {
        const isOpen = question.getAttribute('aria-expanded') === 'true';
        questions.forEach((item) => {
          item.setAttribute('aria-expanded', 'false');
          const answer = document.getElementById(item.getAttribute('aria-controls'));
          if (answer) answer.hidden = true;
          const sign = item.querySelector('span:last-child');
          if (sign) sign.textContent = '+';
        });

        if (!isOpen) {
          question.setAttribute('aria-expanded', 'true');
          const answer = document.getElementById(question.getAttribute('aria-controls'));
          if (answer) answer.hidden = false;
          const sign = question.querySelector('span:last-child');
          if (sign) sign.textContent = '–';
        }
      });
    });
  }

  function initialiseForm() {
    const form = $('#application-form');
    const success = $('#form-success');
    const role = $('#role-select');
    const roleNote = $('#role-note');
    if (!form || !success) return;

    if (role && roleNote) {
      role.addEventListener('change', () => {
        roleNote.hidden = role.value !== 'Hired CEO / Management';
      });
    }

    const clearErrors = () => {
      $$('.field-error', form).forEach((field) => field.classList.remove('field-error'));
      $('.form-message', form)?.remove();
    };

    form.addEventListener('submit', (event) => {
      event.preventDefault();
      clearErrors();

      const invalid = $$('input, select, textarea', form).filter((field) => !field.checkValidity());
      if (invalid.length) {
        invalid.forEach((field) => field.classList.add('field-error'));
        const message = document.createElement('p');
        message.className = 'form-message';
        message.textContent = 'Please complete all required fields and check the founder confirmation box.';
        form.prepend(message);
        invalid[0].focus();
        return;
      }

      // Front-end demo state. Replace this block with fetch() to your CRM or form endpoint.
      form.hidden = true;
      success.hidden = false;
      success.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    $('#reset-form')?.addEventListener('click', () => {
      form.reset();
      clearErrors();
      if (roleNote) roleNote.hidden = true;
      success.hidden = true;
      form.hidden = false;
      form.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    initialiseIcons();
    initialiseMobileMenu();
    initialiseRotatingWord();
    initialiseCountdowns();
    initialiseFaqs();
    initialiseForm();
  });
})();
