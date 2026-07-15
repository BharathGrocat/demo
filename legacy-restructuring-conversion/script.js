'use strict';

const CAMPAIGN_END = new Date('2026-09-15T23:59:59+05:30');
const CTA_LABEL = 'Claim your free restructuring review';

const DATA = {
  ticker: [
    'Legacy Freedom Campaign', 'Freedom to Endure', 'Freedom to Transition',
    'Freedom to Last', 'Freedom Across Generations', 'Freedom from Tangled Ownership',
    'Complimentary Restructuring Review · Jul 15 – Sep 15'
  ],
  heroWords: ['to Endure', 'to Transition', 'to Last'],
  pains: [
    ['moon', 'Struggling to get your finances in order?'],
    ['trending-up', 'Growing revenue, but not seeing it in your bank account?'],
    ['users', 'Watching peers scale while you feel stuck?'],
    ['wallet', 'Wondering where your profits went?'],
    ['droplets', 'Wondering where your cash went?'],
    ['shield-alert', "Worried about a compliance gap you haven't had time to fix?"]
  ],
  included: [
    { n: '01', icon: 'layers', title: 'Cap-table review & clean-up', desc: 'We review and clean up the capital tables across every group entity, reconciling ownership records, clearing legacy errors and giving the whole family one accurate view of who owns what.' },
    { n: '02', icon: 'share-2', title: 'Shareholding restructuring & reallocation', desc: "We restructure and reallocate shareholding across the family and group, aligning ownership with roles, contribution and the next generation's place in the business." },
    { n: '03', icon: 'git-compare', title: 'Evaluation of restructuring options', desc: 'We evaluate the restructuring options open to you, including holding structures, mergers, demergers and consolidation, and set out the trade-offs of each in plain terms.' }
  ],
  tracks: [
    ['landmark', 'Financial Architecture', 'Entity map, intercompany flows and holding structure for businesses that have grown faster than their financial design.'],
    ['shield-check', 'Compliance & Regulatory Health', 'FEMA, RBI, GST and foreign asset disclosure. Surface blind spots before they become notices.'],
    ['trending-up', 'Fundraise Readiness', 'Cap table hygiene, ESOP pool, valuation methodology and investor-facing financials.'],
    ['coins', 'Personal Wealth & Tax', 'Income routing, dividend versus salary, LRS and overseas structure for promoter families.'],
    ['git-fork', 'Succession & Governance', 'Shareholder agreements, succession planning and ring-fencing personal versus business assets.'],
    ['bar-chart-3', 'Management Reporting', 'MIS review, KPI dashboards and best-practice benchmarking for leadership visibility.']
  ],
  strategy: [
    'Anticipate the next three moves: cash, compliance and capital',
    'Protect the pieces that matter: your equity, your family and your peace of mind',
    'Play from a position of clarity, not reaction'
  ],
  receive: [
    'The key ownership and structural issues across your group entities',
    'One quick win you can act on immediately',
    'A restructuring roadmap showing what a full engagement would address'
  ],
  deliveryRows: [
    ['Cap-table issues found', 'Reconciled'],
    ['Quick win', 'Actionable now'],
    ['Restructuring roadmap', '12-month view']
  ],
  steps: [
    { n: '01', icon: 'phone-call', title: 'Family & Promoter Interview', time: '60–90 minutes', desc: 'A senior finance professional sits with the family to understand the group, ownership history and what you want the next generation to inherit.' },
    { n: '02', icon: 'folder-search', title: 'Cap-Table & Structure Review', time: 'Shareholding / entities', desc: 'We review the cap tables, group structure and shareholding records across every entity to establish one accurate picture.' },
    { n: '03', icon: 'pen-line', title: 'Review Note Drafted', time: '2–3 page written note', desc: 'Findings are written plainly, with the ownership and structural issues ranked and the reasoning behind each one.' },
    { n: '04', icon: 'presentation', title: 'Debrief Call', time: '30 minutes', desc: 'We walk you through the note, answer questions and hand you a clear path forward. No pressure, no pitch.' }
  ],
  fitYes: [
    'A 2nd-generation or later family- or promoter-owned business',
    "Multiple group entities with shareholding that's grown tangled over time",
    'An India-based group with FEMA, RBI, GST and Companies Act considerations',
    "You're a family member or promoter carrying the ownership decisions"
  ],
  fitNo: [
    'A single-entity business with a simple, clean cap table',
    'A first-generation startup yet to build any group structure',
    'Ownership already professionally restructured and fully documented',
    'A widely held or listed entity with institutional governance in place'
  ],
  testimonials: [
    { quote: 'The clean-up untangled fifteen years of ad-hoc share transfers across our three companies. For the first time, the whole family sees the same picture.', name: 'Promoter', role: 'Family manufacturing group, Pune', initials: 'RM' },
    { quote: 'We were handing the business to the second generation with shareholding no one fully understood. Their review gave us a structure we could stand behind.', name: 'Promoter family', role: 'Consumer group, Bengaluru', initials: 'SK' },
    { quote: 'Their evaluation of restructuring options saved us from a demerger that would have triggered tax we never saw coming.', name: 'Director', role: 'Family-owned group, Gurugram', initials: 'AV' }
  ],
  about: [
    ['user-check', 'Senior-led', 'A CFO-grade professional runs your file, never a junior analyst.'],
    ['lock', 'Confidential by default', 'Everything you share is used only to prepare your note.'],
    ['scale', 'Regulation-first', 'Grounded in Indian practice, including FEMA, RBI, GST and the Companies Act.']
  ],
  faqs: [
    ["Is it really free? What's the catch?", "It's genuinely free of cost, with no fee and no obligation. It's how we introduce our work to a select group of family businesses. If a full engagement makes sense afterward, we'll say so. If it doesn't, you keep the note and the quick win."],
    ['How much of our time does it take?', "A 60–90 minute interview with the family or promoters, sharing a few documents, and a 30-minute debrief. That's it. We do the 6–8 hours of analysis on our side."],
    ['Who actually does the review?', 'A senior finance professional, not a junior analyst. The whole point is a CFO-grade lens on your group’s ownership and structure.'],
    ['Is our information kept confidential?', 'Entirely. Everything shared is treated as strictly confidential and used only to prepare your review note.'],
    ['What if we already have a CA or auditor?', "Most family groups do. A CA keeps you compliant and closes the books; a restructuring review tells you how to reshape ownership and structure for the next generation. They're complementary."],
    ['Why is it only available July 15 – September 15?', "Each review takes real senior time, so we run it as a fixed window with a limited number of slots. Once they're filled, applications close."]
  ]
};

const icon = (name) => `<i data-lucide="${name}"></i>`;

function renderContent() {
  const tickerItems = [...DATA.ticker, ...DATA.ticker];
  document.getElementById('tickerTrack').innerHTML = tickerItems.map(item =>
    `<span class="ticker-item"><span>${item}</span><span class="diamond">◆</span></span>`
  ).join('');

  document.getElementById('painGrid').innerHTML = DATA.pains.map(([name, text]) =>
    `<article class="pain-card"><span class="pain-icon">${icon(name)}</span><p>${text}</p></article>`
  ).join('');

  document.getElementById('includedGrid').innerHTML = DATA.included.map(item =>
    `<article class="included-card"><div class="card-top"><span class="card-icon">${icon(item.icon)}</span><span class="card-number">${item.n}</span></div><h3 class="serif">${item.title}</h3><p>${item.desc}</p></article>`
  ).join('');

  document.getElementById('tracksGrid').innerHTML = DATA.tracks.map(([name, title, desc]) =>
    `<article class="track-card"><span class="card-icon">${icon(name)}</span><h3 class="serif">${title}</h3><p>${desc}</p></article>`
  ).join('');

  document.getElementById('strategyPoints').innerHTML = DATA.strategy.map(item =>
    `<div class="strategy-point">${icon('check')}<span>${item}</span></div>`
  ).join('');

  document.getElementById('receiveList').innerHTML = DATA.receive.map(item =>
    `<div class="receive-item"><span class="receive-check">${icon('check')}</span><p>${item}</p></div>`
  ).join('');

  document.getElementById('deliveryRows').innerHTML = DATA.deliveryRows.map(([key, value]) =>
    `<div class="delivery-row"><span>${key}</span><strong>${value}</strong></div>`
  ).join('');

  document.getElementById('stepsGrid').innerHTML = DATA.steps.map(step =>
    `<article class="step-card"><div class="step-top"><span class="step-number">${step.n}</span><span class="step-icon">${icon(step.icon)}</span></div><h3 class="serif">${step.title}</h3><span class="step-time">${step.time}</span><p>${step.desc}</p></article>`
  ).join('');

  document.getElementById('fitYes').innerHTML = DATA.fitYes.map(item =>
    `<div class="fit-item">${icon('check')}<span>${item}</span></div>`
  ).join('');
  document.getElementById('fitNo').innerHTML = DATA.fitNo.map(item =>
    `<div class="fit-item">${icon('minus')}<span>${item}</span></div>`
  ).join('');

  document.getElementById('testimonialsGrid').innerHTML = DATA.testimonials.map(item =>
    `<article class="testimonial-card"><div class="quote-mark">“</div><blockquote>${item.quote}</blockquote><div class="testimonial-person"><span class="initials">${item.initials}</span><div><strong>${item.name}</strong><span>${item.role}</span></div></div></article>`
  ).join('');

  document.getElementById('aboutStats').innerHTML = DATA.about.map(([name, title, desc]) =>
    `<article class="about-stat"><span class="about-icon">${icon(name)}</span><div><strong>${title}</strong><p>${desc}</p></div></article>`
  ).join('');

  document.getElementById('faqList').innerHTML = DATA.faqs.map(([question, answer], index) =>
    `<article class="faq-item"><button class="faq-question" type="button" aria-expanded="${index === 0}" aria-controls="faq-answer-${index}"><span>${question}</span><span class="faq-sign">${index === 0 ? '–' : '+'}</span></button><div class="faq-answer" id="faq-answer-${index}" ${index === 0 ? '' : 'hidden'}>${answer}</div></article>`
  ).join('');
}

function setupIcons() {
  const draw = () => {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons({ attrs: { 'stroke-width': 1.7 } });
      return true;
    }
    return false;
  };
  if (!draw()) {
    let attempts = 0;
    const timer = window.setInterval(() => {
      attempts += 1;
      if (draw() || attempts > 30) window.clearInterval(timer);
    }, 100);
  }
}

function setupMobileMenu() {
  const button = document.getElementById('menuButton');
  const menu = document.getElementById('mobileNav');
  const close = () => {
    menu.hidden = true;
    button.setAttribute('aria-expanded', 'false');
    button.innerHTML = icon('menu');
    setupIcons();
  };
  button.addEventListener('click', () => {
    const isOpen = !menu.hidden;
    menu.hidden = isOpen;
    button.setAttribute('aria-expanded', String(!isOpen));
    button.innerHTML = icon(isOpen ? 'menu' : 'x');
    setupIcons();
  });
  menu.querySelectorAll('a').forEach(link => link.addEventListener('click', close));
}

function setupRotatingWord() {
  const target = document.getElementById('rotatingWord');
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  let index = 0;
  window.setInterval(() => {
    target.classList.add('is-changing');
    window.setTimeout(() => {
      index = (index + 1) % DATA.heroWords.length;
      target.textContent = DATA.heroWords[index];
      target.classList.remove('is-changing');
    }, 260);
  }, 2800);
}

function setupCountdowns() {
  const update = () => {
    const now = new Date();
    const distance = Math.max(0, CAMPAIGN_END.getTime() - now.getTime());
    const days = Math.floor(distance / 86400000);
    const hours = Math.floor((distance / 3600000) % 24);
    const minutes = Math.floor((distance / 60000) % 60);
    const seconds = Math.floor((distance / 1000) % 60);
    const units = [['Days', days], ['Hours', hours], ['Mins', minutes], ['Secs', seconds]];
    document.querySelectorAll('[data-countdown]').forEach(el => {
      el.innerHTML = units.map(([label, value]) => `<div class="countdown-unit"><strong>${String(value).padStart(2, '0')}</strong><span>${label}</span></div>`).join('');
    });
  };
  update();
  window.setInterval(update, 1000);
}

function setupFaqs() {
  const items = [...document.querySelectorAll('.faq-item')];
  items.forEach((item, index) => {
    const button = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');
    const sign = item.querySelector('.faq-sign');
    button.addEventListener('click', () => {
      const opening = button.getAttribute('aria-expanded') !== 'true';
      items.forEach((other, otherIndex) => {
        const otherButton = other.querySelector('.faq-question');
        const otherAnswer = other.querySelector('.faq-answer');
        const otherSign = other.querySelector('.faq-sign');
        const openThis = otherIndex === index && opening;
        otherButton.setAttribute('aria-expanded', String(openThis));
        otherAnswer.hidden = !openThis;
        otherSign.textContent = openThis ? '–' : '+';
      });
    });
  });
}

function setupForm() {
  const form = document.getElementById('applicationForm');
  const role = document.getElementById('roleSelect');
  const notice = document.getElementById('roleNotice');
  const success = document.getElementById('successState');
  const submitAnother = document.getElementById('submitAnother');

  role.addEventListener('change', () => {
    notice.hidden = role.value !== 'Hired CEO / Management';
  });

  form.addEventListener('submit', event => {
    event.preventDefault();
    const requiredFields = [...form.querySelectorAll('[required]')];
    let valid = true;
    requiredFields.forEach(field => {
      const invalid = field.type === 'checkbox' ? !field.checked : !field.checkValidity();
      field.classList.toggle('invalid', invalid);
      if (invalid) valid = false;
    });
    if (!valid) {
      const firstInvalid = form.querySelector('.invalid');
      firstInvalid?.focus();
      return;
    }
    form.hidden = true;
    success.hidden = false;
    success.scrollIntoView({ behavior: 'smooth', block: 'center' });
    setupIcons();
  });

  form.addEventListener('input', event => event.target.classList.remove('invalid'));
  form.addEventListener('change', event => event.target.classList.remove('invalid'));

  submitAnother.addEventListener('click', () => {
    form.reset();
    notice.hidden = true;
    success.hidden = true;
    form.hidden = false;
    form.querySelector('input')?.focus();
  });
}

function init() {
  renderContent();
  setupIcons();
  setupMobileMenu();
  setupRotatingWord();
  setupCountdowns();
  setupFaqs();
  setupForm();
}

document.addEventListener('DOMContentLoaded', init);
