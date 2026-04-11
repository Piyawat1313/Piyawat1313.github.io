<?php
declare(strict_types=1);

session_start();
if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

$supportedLangs = ['th', 'en'];
$lang = 'th';
if (isset($_GET['lang'])) {
  $q = strtolower((string)$_GET['lang']);
  if (in_array($q, $supportedLangs, true)) {
    $lang = $q;
    setcookie('lang', $lang, [
      'expires' => time() + 86400 * 180,
      'path' => '/',
      'secure' => !empty($_SERVER['HTTPS']),
      'httponly' => false,
      'samesite' => 'Lax',
    ]);
  }
} elseif (!empty($_COOKIE['lang'])) {
  $c = strtolower((string)$_COOKIE['lang']);
  if (in_array($c, $supportedLangs, true)) {
    $lang = $c;
  }
}

$brand = [
  'name' => 'AURUM NOIR',
  'tagline' => 'Luxury mood. Everyday confidence.',
  'product' => 'Aurum Noir — Eau de Parfum',
  'price' => 2890,
  'currency' => '฿',
  'cta_primary' => ['th' => 'สั่งซื้อทันที', 'en' => 'Order now'],
  'cta_secondary' => ['th' => 'ดูรายละเอียด', 'en' => 'See details'],
];

$t = [
  'th' => [
    'skip' => 'ข้ามไปยังเนื้อหา',
    'nav_features' => 'จุดเด่น',
    'nav_notes' => 'โน้ตกลิ่น',
    'nav_pricing' => 'ราคา',
    'nav_faq' => 'คำถาม',
    'pill' => 'ส่งวันนี้ • เก็บเงินปลายทาง • แพ็กพรีเมียม',
    'hero_headline' => 'กลิ่นที่ทำให้ลุคดู “แพง” แบบไม่ต้องพยายาม',
    'hero_desc' => 'โทนหรูสะอาด-นุ่มลึก สร้างภาพจำตั้งแต่ก้าวแรก เหมาะสำหรับคนที่อยากได้ “Luxury vibe” ในทุกวัน',
    'hero_guarantee' => 'การันตีความพรีเมียม',
    'kpi_sat' => 'ความพึงพอใจ',
    'kpi_last' => 'ติดทน',
    'kpi_hours' => 'ชม.',
    'kpi_for' => 'เหมาะสำหรับ',
    'card_price_label' => 'ราคาโปรเปิดตัว',
    'card_includes' => 'รวมแพ็กพรีเมียม + คู่มือการฉีดให้ติดทน',
    'badge_auth' => 'ของแท้ 100%',
    'badge_fast' => 'ส่งไว',
    'badge_clean' => 'กลิ่นสะอาด',
    'mock_note' => 'ภาพสินค้าเป็น Mockup สำหรับงานดีไซน์ สามารถแทนที่ด้วยรูปจริงได้ทันที',
    'why_kicker' => "WHY YOU'LL LOVE IT",
    'why_title' => 'จุดเด่นที่ทำให้รู้สึก “Luxury” ตั้งแต่ครั้งแรก',
    'why_desc' => 'UI เน้นอ่านง่าย กดง่าย และสื่อสารชัด โดยใช้ไอคอนช่วยสแกนข้อมูลได้เร็วบนมือถือ',
    'scent_kicker' => 'SCENT PYRAMID',
    'scent_title' => 'โน้ตกลิ่นที่ “นุ่มลึก” แต่สะอาด',
    'scent_desc' => 'เลเยอร์กลิ่นถูกออกแบบให้เริ่มสดใส → หรูนุ่ม → ปิดท้ายอุ่นสะอาด ติดผิวสวย',
    'feel_tone' => 'โทนความรู้สึก',
    'tips_title' => 'วิธีให้ติดทน',
    'tip1' => 'ฉีดจุดชีพจร 3–5 สเปรย์',
    'tip2' => 'ทามอยส์เจอร์ก่อนฉีด',
    'tip3' => 'เลี่ยงการถูข้อมือ',
    'spec_kicker' => 'SPECIFICATIONS',
    'spec_title' => 'สเปค & บริการ',
    'spec_desc' => 'ข้อมูลสำคัญอยู่ในบล็อกเดียว อ่านไวบนมือถือ',
    'rev_kicker' => 'REVIEWS',
    'rev_title' => 'เสียงจากลูกค้า',
    'rev_desc' => 'คัดรีวิวสั้น กระชับ เน้นความน่าเชื่อถือ',
    'best_kicker' => 'BEST VALUE',
    'best_title' => 'โปรเปิดตัว',
    'best_desc' => 'จบครบในชุดเดียว เหมาะสำหรับเริ่มต้นหรือซื้อเป็นของขวัญ',
    'price_today' => 'วันนี้',
    'li_ship' => 'ส่งเร็ว พร้อมเลขพัสดุ',
    'li_cod' => 'เก็บเงินปลายทาง (COD)',
    'li_return' => 'รับเปลี่ยน/คืนภายใน 7 วัน (ตามเงื่อนไข)',
    'order_hint' => 'กดสั่งซื้อแล้วกรอกข้อมูลด้านล่างได้เลย',
    'order_kicker' => 'ORDER',
    'order_title' => 'ฟอร์มสั่งซื้อ (ตัวอย่าง)',
    'order_desc' => 'ออกแบบให้กรอกง่ายบนมือถือ (input ใหญ่, spacing ชัด)',
    'name_label' => 'ชื่อ-นามสกุล',
    'name_ph' => 'เช่น พิยะ วัฒนา',
    'phone_label' => 'เบอร์โทร',
    'phone_ph' => 'เช่น 08x-xxx-xxxx',
    'addr_label' => 'ที่อยู่จัดส่ง',
    'addr_ph' => 'บ้านเลขที่, ถนน, แขวง/ตำบล, เขต/อำเภอ, จังหวัด, รหัสไปรษณีย์',
    'qty_label' => 'จำนวน',
    'qty1' => '1 ชิ้น',
    'qty2' => '2 ชิ้น',
    'qty3' => '3 ชิ้น',
    'pay_label' => 'ชำระเงิน',
    'pay_cod' => 'เก็บเงินปลายทาง (COD)',
    'pay_transfer' => 'โอน/พร้อมเพย์',
    'submit' => 'ยืนยันสั่งซื้อ',
    'order_note' => 'หมายเหตุ: ฟอร์มนี้เป็น UI ตัวอย่าง (ยังไม่ผูกการบันทึก/ส่งออเดอร์) — ถ้าต้องการให้เชื่อม LINE / อีเมล / DB บอกได้ครับ',
    'faq_kicker' => 'FAQ',
    'faq_title' => 'คำถามที่พบบ่อย',
    'faq_desc' => 'ใช้ accordion แบบ native (`details`) เบาและรองรับมือถือดี',
    'cta_kicker' => 'READY TO UPGRADE',
    'cta_title' => 'ยกระดับลุคให้ดูแพงใน 10 วินาที',
    'cta_desc' => 'กดสั่งซื้อ แล้วกรอกฟอร์มด้านบนได้เลย ใช้งานง่ายบนมือถือ',
    'cta_again' => 'ดูจุดเด่นอีกครั้ง',
    'footer_sub' => 'Luxury one-page (PHP + Tailwind)',
    'meta_desc' => 'One page luxury landing — โทนดำทอง รองรับมือถือ UX/UI เนียน ๆ พร้อมปุ่มสั่งซื้อ',
    'lang_th' => 'ภาษาไทย',
    'lang_en' => 'English',
    'chat_open' => 'แชทกับเรา',
    'chat_title' => 'Live Chat',
    'chat_subtitle' => 'ตอบไวในเวลาทำการ',
    'chat_placeholder' => 'พิมพ์ข้อความ…',
    'chat_send' => 'ส่ง',
    'chat_clear' => 'ล้างแชท',
    'chat_greeting' => 'สวัสดีครับ ต้องการให้ช่วยแนะนำสินค้า/การสั่งซื้อไหมครับ?',
    'chat_agent' => 'แอดมิน',
    'chat_you' => 'คุณ',
    'chat_error' => 'ส่งข้อความไม่สำเร็จ ลองใหม่อีกครั้ง',
  ],
  'en' => [
    'skip' => 'Skip to content',
    'nav_features' => 'Highlights',
    'nav_notes' => 'Scent notes',
    'nav_pricing' => 'Pricing',
    'nav_faq' => 'FAQ',
    'pill' => 'Ships today • Cash on delivery • Premium packaging',
    'hero_headline' => 'Look expensive without trying',
    'hero_desc' => 'A clean-luxury profile with a deep, soft finish—crafted for everyday confidence, day or night.',
    'hero_guarantee' => 'Premium quality guaranteed',
    'kpi_sat' => 'Satisfaction',
    'kpi_last' => 'Longevity',
    'kpi_hours' => 'hrs',
    'kpi_for' => 'For',
    'card_price_label' => 'Launch price',
    'card_includes' => 'Premium packaging + wear-longer spray guide',
    'badge_auth' => '100% authentic',
    'badge_fast' => 'Fast shipping',
    'badge_clean' => 'Clean scent',
    'mock_note' => 'Product image is a design mockup. Replace with real photos anytime.',
    'why_kicker' => "WHY YOU'LL LOVE IT",
    'why_title' => 'Luxury feel from the first spray',
    'why_desc' => 'Mobile-first layout with icons for faster scanning—easy to read, easy to tap.',
    'scent_kicker' => 'SCENT PYRAMID',
    'scent_title' => 'Soft, deep, and clean',
    'scent_desc' => 'A layered journey: bright opening → smooth luxury heart → warm clean dry-down.',
    'feel_tone' => 'How it feels',
    'tips_title' => 'Make it last',
    'tip1' => '3–5 sprays on pulse points',
    'tip2' => 'Moisturize before spraying',
    'tip3' => 'Avoid rubbing your wrists',
    'spec_kicker' => 'SPECIFICATIONS',
    'spec_title' => 'Specs & service',
    'spec_desc' => 'Key details in one place—quick to scan on mobile.',
    'rev_kicker' => 'REVIEWS',
    'rev_title' => 'What customers say',
    'rev_desc' => 'Short, credible reviews—straight to the point.',
    'best_kicker' => 'BEST VALUE',
    'best_title' => 'Launch offer',
    'best_desc' => 'Everything you need in one set—great for first-time buyers or gifting.',
    'price_today' => 'Today',
    'li_ship' => 'Fast shipping with tracking',
    'li_cod' => 'Cash on delivery (COD)',
    'li_return' => '7-day returns (terms apply)',
    'order_hint' => 'Tap order and fill in the form below.',
    'order_kicker' => 'ORDER',
    'order_title' => 'Order form (demo)',
    'order_desc' => 'Designed for mobile: large inputs, clear spacing.',
    'name_label' => 'Full name',
    'name_ph' => 'e.g., John Appleseed',
    'phone_label' => 'Phone',
    'phone_ph' => 'e.g., +66xx-xxx-xxxx',
    'addr_label' => 'Shipping address',
    'addr_ph' => 'House no., street, district, province, postal code',
    'qty_label' => 'Quantity',
    'qty1' => '1 item',
    'qty2' => '2 items',
    'qty3' => '3 items',
    'pay_label' => 'Payment',
    'pay_cod' => 'Cash on delivery (COD)',
    'pay_transfer' => 'Bank transfer / PromptPay',
    'submit' => 'Place order',
    'order_note' => 'Note: This form is UI demo only (not yet wired to order processing). Tell me if you want LINE / email / DB integration.',
    'faq_kicker' => 'FAQ',
    'faq_title' => 'Frequently asked questions',
    'faq_desc' => 'Lightweight native accordion using `details`—great on mobile.',
    'cta_kicker' => 'READY TO UPGRADE',
    'cta_title' => 'Upgrade your vibe in 10 seconds',
    'cta_desc' => 'Tap order, fill the form above—built for mobile.',
    'cta_again' => 'View highlights again',
    'footer_sub' => 'Luxury one-page (PHP + Tailwind)',
    'meta_desc' => 'Luxury one-page landing in black & gold, mobile-ready UX/UI with clear CTAs.',
    'lang_th' => 'Thai',
    'lang_en' => 'English',
    'chat_open' => 'Chat with us',
    'chat_title' => 'Live Chat',
    'chat_subtitle' => 'Fast replies in business hours',
    'chat_placeholder' => 'Type a message…',
    'chat_send' => 'Send',
    'chat_clear' => 'Clear chat',
    'chat_greeting' => 'Hi! Want help with product details or ordering?',
    'chat_agent' => 'Admin',
    'chat_you' => 'You',
    'chat_error' => 'Message failed to send. Please try again.',
  ],
];

function h(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function t(array $t, string $lang, string $key): string {
  return $t[$lang][$key] ?? $t['th'][$key] ?? $key;
}

function format_price(int $n): string {
  return number_format($n);
}

function lang_url(string $lang): string {
  $path = strtok((string)($_SERVER['REQUEST_URI'] ?? ''), '?');
  if ($path === false || $path === '') {
    $path = (string)($_SERVER['PHP_SELF'] ?? '/');
  }
  return $path . '?lang=' . rawurlencode($lang);
}

$chatSessionKey = 'livechat_messages';
if (!isset($_SESSION[$chatSessionKey]) || !is_array($_SESSION[$chatSessionKey])) {
  $_SESSION[$chatSessionKey] = [];
}
if (count($_SESSION[$chatSessionKey]) === 0) {
  $_SESSION[$chatSessionKey][] = [
    'id' => bin2hex(random_bytes(8)),
    'role' => 'agent',
    'name' => 'Admin',
    'text' => t($t, $lang, 'chat_greeting'),
    'ts' => time(),
  ];
}

function json_response(array $data, int $status = 200): never {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  header('Cache-Control: no-store, max-age=0');
  echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}

function normalize_msg(string $s): string {
  $s = trim(preg_replace('/\s+/u', ' ', $s) ?? '');
  if (mb_strlen($s, 'UTF-8') > 800) {
    $s = mb_substr($s, 0, 800, 'UTF-8');
  }
  return $s;
}

function auto_reply(string $lang, array $t, string $msg): string {
  $m = mb_strtolower($msg, 'UTF-8');
  $isTh = ($lang === 'th');

  if (str_contains($m, 'ราคา') || str_contains($m, 'price')) {
    return $isTh ? 'ราคาโปรเปิดตัวอยู่ที่ ฿2,890 ครับ ต้องการสั่งกี่ชิ้นดีครับ?' : 'The launch price is ฿2,890. How many would you like to order?';
  }
  if (str_contains($m, 'ส่ง') || str_contains($m, 'shipping') || str_contains($m, 'delivery')) {
    return $isTh ? 'จัดส่งเร็ว 1–2 วันทำการ (ในเขตเมือง) และมีเลขพัสดุให้ครับ' : 'Fast shipping (1–2 business days in metro areas) with tracking provided.';
  }
  if (str_contains($m, 'ปลายทาง') || str_contains($m, 'cod')) {
    return $isTh ? 'มีเก็บเงินปลายทาง (COD) ครับ' : 'Yes—cash on delivery (COD) is available.';
  }
  if (str_contains($m, 'คืน') || str_contains($m, 'return') || str_contains($m, 'exchange')) {
    return $isTh ? 'รับเปลี่ยน/คืนภายใน 7 วัน (ตามเงื่อนไข) ครับ' : 'Returns/exchanges within 7 days (terms apply).';
  }
  if (str_contains($m, 'สั่ง') || str_contains($m, 'order')) {
    return $isTh ? 'ได้เลยครับ กดปุ่ม “สั่งซื้อทันที” แล้วกรอกฟอร์มด้านล่างได้เลย' : 'Sure—tap “Order now” and fill the form below.';
  }
  return $isTh ? 'รับทราบครับ อยากให้ช่วยเรื่องไหนเพิ่มเติม (ราคา/การจัดส่ง/วิธีสั่งซื้อ)?' : 'Got it. What would you like help with (price, shipping, ordering)?';
}

if (isset($_GET['action'])) {
  $action = (string)$_GET['action'];
  if ($action === 'chat_history') {
    json_response([
      'ok' => true,
      'csrf' => $_SESSION['csrf'],
      'messages' => array_values($_SESSION[$chatSessionKey]),
    ]);
  }

  if ($action === 'chat_clear') {
    if (($_POST['csrf'] ?? '') !== $_SESSION['csrf']) {
      json_response(['ok' => false, 'error' => 'csrf'], 403);
    }
    $_SESSION[$chatSessionKey] = [];
    $_SESSION[$chatSessionKey][] = [
      'id' => bin2hex(random_bytes(8)),
      'role' => 'agent',
      'name' => 'Admin',
      'text' => t($t, $lang, 'chat_greeting'),
      'ts' => time(),
    ];
    json_response(['ok' => true, 'messages' => array_values($_SESSION[$chatSessionKey])]);
  }

  if ($action === 'chat_send') {
    if (($_POST['csrf'] ?? '') !== $_SESSION['csrf']) {
      json_response(['ok' => false, 'error' => 'csrf'], 403);
    }
    $raw = (string)($_POST['message'] ?? '');
    $msg = normalize_msg($raw);
    if ($msg === '') {
      json_response(['ok' => false, 'error' => 'empty'], 422);
    }

    $lastTs = (int)($_SESSION['chat_last_ts'] ?? 0);
    if ($lastTs > 0 && (time() - $lastTs) < 1) {
      json_response(['ok' => false, 'error' => 'rate_limited'], 429);
    }
    $_SESSION['chat_last_ts'] = time();

    $_SESSION[$chatSessionKey][] = [
      'id' => bin2hex(random_bytes(8)),
      'role' => 'user',
      'name' => 'You',
      'text' => $msg,
      'ts' => time(),
    ];

    $_SESSION[$chatSessionKey][] = [
      'id' => bin2hex(random_bytes(8)),
      'role' => 'agent',
      'name' => 'Admin',
      'text' => auto_reply($lang, $t, $msg),
      'ts' => time(),
    ];

    if (count($_SESSION[$chatSessionKey]) > 80) {
      $_SESSION[$chatSessionKey] = array_slice($_SESSION[$chatSessionKey], -80);
    }

    json_response(['ok' => true, 'messages' => array_values($_SESSION[$chatSessionKey])]);
  }

  json_response(['ok' => false, 'error' => 'unknown_action'], 404);
}

$highlightsByLang = [
  'th' => [
    [
      'title' => 'กลิ่นหรู โทนดำทอง',
      'desc' => 'บาลานซ์ความนุ่มลึกกับความสะอาดแบบลักชัวรี่ ใช้ได้ทั้งกลางวันและกลางคืน',
      'icon' => 'spark',
    ],
    [
      'title' => 'ติดทนยาวนาน',
      'desc' => 'แนวกลิ่นชัดแบบพอดี ไม่ฉุนเกิน ระยะฟุ้งกำลังดีสำหรับงานและเดต',
      'icon' => 'clock',
    ],
    [
      'title' => 'แพ็กเกจพรีเมียม',
      'desc' => 'ขวดแก้วหนาพร้อมฝาแม่เหล็ก โทนดำด้านตัดทอง ดูดีเป็นของขวัญ',
      'icon' => 'gift',
    ],
    [
      'title' => 'ส่งเร็ว เก็บเงินปลายทาง',
      'desc' => 'แพ็กแน่น กันกระแทก พร้อมแจ้งเลขพัสดุทันทีเมื่อจัดส่ง',
      'icon' => 'truck',
    ],
  ],
  'en' => [
    [
      'title' => 'Clean luxury profile',
      'desc' => 'Balanced depth with a clean-luxury vibe—perfect for day-to-night wear.',
      'icon' => 'spark',
    ],
    [
      'title' => 'Long-lasting wear',
      'desc' => 'Noticeable but never overpowering—ideal projection for work and dates.',
      'icon' => 'clock',
    ],
    [
      'title' => 'Premium packaging',
      'desc' => 'Thick glass bottle with a magnetic cap—matte black with gold accents, gift-ready.',
      'icon' => 'gift',
    ],
    [
      'title' => 'Fast shipping + COD',
      'desc' => 'Secure packing with tracking provided as soon as it ships.',
      'icon' => 'truck',
    ],
  ],
];
$highlights = $highlightsByLang[$lang];

$notes = [
  ['tier' => 'Top Notes', 'items' => ['Bergamot', 'Pink Pepper', 'Black Tea']],
  ['tier' => 'Heart Notes', 'items' => ['Jasmine', 'Iris', 'Cedarwood']],
  ['tier' => 'Base Notes', 'items' => ['Amber', 'Vanilla', 'Musk']],
];

$specs = [
  ['k' => $lang === 'th' ? 'ขนาด' : 'Size', 'v' => '50 ml'],
  ['k' => $lang === 'th' ? 'ประเภท' : 'Type', 'v' => 'Eau de Parfum (EDP)'],
  ['k' => $lang === 'th' ? 'โทนกลิ่น' : 'Profile', 'v' => 'Woody • Amber • Clean'],
  ['k' => $lang === 'th' ? 'เหมาะสำหรับ' : 'Best for', 'v' => $lang === 'th' ? 'ทำงาน / ออกงาน / ของขวัญ' : 'Work / events / gifting'],
  ['k' => $lang === 'th' ? 'การจัดส่ง' : 'Shipping', 'v' => $lang === 'th' ? '1–2 วันทำการ (ในเขตเมือง)' : '1–2 business days (metro areas)'],
  ['k' => $lang === 'th' ? 'การรับประกัน' : 'Policy', 'v' => $lang === 'th' ? 'เปลี่ยน/คืนภายใน 7 วัน (ตามเงื่อนไข)' : '7-day returns (terms apply)'],
];

$testimonials = [
  [
    'name' => $lang === 'th' ? 'ปิยะ' : 'Piya',
    'role' => $lang === 'th' ? 'ลูกค้าประจำ' : 'Repeat customer',
    'quote' => $lang === 'th'
      ? 'กลิ่นสะอาดแต่มีความลึก ดูแพงมาก ฟุ้งกำลังดี ใส่ไปทำงานได้ทุกวัน'
      : 'Clean but deep—feels expensive. Great projection. I wear it to work daily.',
    'rating' => 5,
  ],
  [
    'name' => $lang === 'th' ? 'มิน' : 'Min',
    'role' => $lang === 'th' ? 'ซื้อเป็นของขวัญ' : 'Bought as a gift',
    'quote' => $lang === 'th'
      ? 'กล่องกับขวดสวยมาก คนรับชอบสุด ๆ กลิ่นติดทนทั้งวันเลย'
      : 'The box and bottle look amazing. The recipient loved it—lasts all day.',
    'rating' => 5,
  ],
  [
    'name' => $lang === 'th' ? 'นนท์' : 'Non',
    'role' => $lang === 'th' ? 'สายมินิมอล' : 'Minimalist',
    'quote' => $lang === 'th'
      ? 'ไม่หวานเกิน ไม่ฉุน สะอาดหรูแบบที่หาอยู่พอดี'
      : 'Not too sweet, not harsh—exactly the clean-luxury vibe I wanted.',
    'rating' => 4,
  ],
];

$faqs = [
  [
    'q' => $lang === 'th' ? 'เหมาะกับผู้หญิง/ผู้ชายไหม?' : 'Is it for women or men?',
    'a' => $lang === 'th' ? 'เป็นกลิ่น Unisex โทนสะอาด-วู้ดดี้ ใส่ได้ทุกเพศและทุกโอกาส' : 'It’s a unisex clean-woody profile—made for everyone and any occasion.',
  ],
  [
    'q' => $lang === 'th' ? 'ติดทนประมาณกี่ชั่วโมง?' : 'How long does it last?',
    'a' => $lang === 'th' ? 'โดยเฉลี่ย 6–10 ชั่วโมง (ขึ้นกับสภาพผิว อุณหภูมิ และการฉีด)' : 'Typically 6–10 hours depending on skin, weather, and how many sprays.',
  ],
  [
    'q' => $lang === 'th' ? 'มีเก็บเงินปลายทางไหม?' : 'Do you offer cash on delivery?',
    'a' => $lang === 'th' ? 'มีบริการเก็บเงินปลายทาง พร้อมแจ้งเลขพัสดุหลังจัดส่ง' : 'Yes—COD is available. You’ll receive tracking right after shipment.',
  ],
  [
    'q' => $lang === 'th' ? 'เปลี่ยน/คืนได้หรือไม่?' : 'Can I return or exchange?',
    'a' => $lang === 'th' ? 'รับเปลี่ยน/คืนภายใน 7 วันตามเงื่อนไขสินค้าและแพ็กเกจต้องสมบูรณ์' : 'Returns/exchanges within 7 days (terms apply; packaging must be intact).',
  ],
];

function icon_svg(string $name, string $class = 'h-6 w-6'): string {
  $common = 'fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"';
  $svgOpen = '<svg class="'.h($class).'" viewBox="0 0 24 24" '.$common.' aria-hidden="true">';
  $svgClose = '</svg>';

  switch ($name) {
    case 'spark':
      $path = '<path d="M12 2l1.2 4.2L17 8l-3.8 1.8L12 14l-1.2-4.2L7 8l3.8-1.8L12 2z"/><path d="M5 14l.7 2.4L8 17.5l-2.3 1.1L5 21l-.7-2.4L2 17.5l2.3-1.1L5 14z"/><path d="M19 13l.8 2.7L22 17l-2.2 1.3L19 21l-.8-2.7L16 17l2.2-1.3L19 13z"/>';
      break;
    case 'clock':
      $path = '<path d="M12 7v6l4 2"/><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
      break;
    case 'gift':
      $path = '<path d="M20 12v9H4v-9"/><path d="M2 7h20v5H2z"/><path d="M12 7v14"/><path d="M12 7h4.5a2.5 2.5 0 10-2.5-2.5C14 5.9 12 7 12 7z"/><path d="M12 7H7.5A2.5 2.5 0 1010 4.5C10 5.9 12 7 12 7z"/>';
      break;
    case 'truck':
      $path = '<path d="M3 7h11v10H3z"/><path d="M14 10h4l3 3v4h-7z"/><path d="M7 17a2 2 0 104 0 2 2 0 00-4 0z"/><path d="M16 17a2 2 0 104 0 2 2 0 00-4 0z"/>';
      break;
    case 'shield':
      $path = '<path d="M12 2l8 4v6c0 5-3.2 9.4-8 10-4.8-.6-8-5-8-10V6l8-4z"/><path d="M9 12l2 2 4-5"/>';
      break;
    case 'leaf':
      $path = '<path d="M20 3c-7 0-12 5-12 12 0 3 1 5 2 6 1 1 3 2 6 2 7 0 12-5 12-12 0-3-1-5-2-6-1-1-3-2-6-2z" transform="translate(-8 0)"/><path d="M7 21c2-6 7-10 13-12"/>';
      break;
    case 'drop':
      $path = '<path d="M12 2s6 7 6 12a6 6 0 11-12 0c0-5 6-12 6-12z"/>';
      break;
    default:
      $path = '<path d="M12 2v20"/><path d="M2 12h20"/>';
  }

  return $svgOpen.$path.$svgClose;
}

function flag_svg(string $lang, string $class = 'h-4 w-6'): string {
  $class = h($class);
  if ($lang === 'th') {
    // Thailand flag (approx)
    return '<svg class="'.$class.'" viewBox="0 0 30 20" role="img" aria-hidden="true"><rect width="30" height="20" rx="3" fill="#fff"/><rect width="30" height="4" y="0" fill="#B5002D"/><rect width="30" height="4" y="16" fill="#B5002D"/><rect width="30" height="4" y="4" fill="#fff"/><rect width="30" height="8" y="6" fill="#2D2A8C"/></svg>';
  }
  // US flag (simplified)
  return '<svg class="'.$class.'" viewBox="0 0 30 20" role="img" aria-hidden="true"><rect width="30" height="20" rx="3" fill="#fff"/><g fill="#B22234"><rect y="0" width="30" height="2"/><rect y="4" width="30" height="2"/><rect y="8" width="30" height="2"/><rect y="12" width="30" height="2"/><rect y="16" width="30" height="2"/></g><rect width="13" height="9" rx="2" fill="#3C3B6E"/><g fill="#fff" opacity=".9"><circle cx="3" cy="2.5" r=".6"/><circle cx="6" cy="2.5" r=".6"/><circle cx="9" cy="2.5" r=".6"/><circle cx="3" cy="5" r=".6"/><circle cx="6" cy="5" r=".6"/><circle cx="9" cy="5" r=".6"/><circle cx="3" cy="7.5" r=".6"/><circle cx="6" cy="7.5" r=".6"/><circle cx="9" cy="7.5" r=".6"/></g></svg>';
}
?>
<!doctype html>
<html lang="<?= h($lang) ?>">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= h($brand['name']) ?> | <?= h($brand['product']) ?></title>
  <meta name="description" content="<?= h(t($t, $lang, 'meta_desc')) ?>" />
  <meta name="theme-color" content="#050507" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Noto Sans Thai','Montserrat','ui-sans-serif','system-ui'],
          },
          colors: {
            noir: {
              950: '#050507',
              900: '#0B0B10',
              800: '#11111A',
              700: '#1B1B26'
            },
            aurum: {
              50:  '#FFF7DF',
              100: '#FDEDBA',
              200: '#F6D98B',
              300: '#EEC45C',
              400: '#E5AE3A',
              500: '#D99A1A',
              600: '#B77D10',
              700: '#8F5F0C',
              800: '#6B470A',
              900: '#4A3207'
            }
          },
          boxShadow: {
            gold: '0 0 0 1px rgba(238,196,92,0.25), 0 18px 45px rgba(0,0,0,0.55)',
          }
        }
      }
    }
  </script>
  <style>
    .gold-text {
      background: linear-gradient(180deg, #FFF7DF 0%, #EEC45C 30%, #D99A1A 65%, #B77D10 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .noise {
      background-image:
        radial-gradient(1200px 600px at 10% 10%, rgba(238,196,92,0.14), transparent 60%),
        radial-gradient(900px 500px at 90% 10%, rgba(217,154,26,0.10), transparent 55%),
        radial-gradient(900px 700px at 40% 90%, rgba(238,196,92,0.10), transparent 55%),
        linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0));
    }
    .chat-scrollbar::-webkit-scrollbar { width: 10px; }
    .chat-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.10); border-radius: 999px; border: 2px solid rgba(0,0,0,0); background-clip: padding-box; }
  </style>
</head>
<body class="bg-noir-950 text-zinc-100 antialiased selection:bg-aurum-300/30 selection:text-aurum-50">
  <a href="#content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-lg focus:bg-noir-800 focus:px-4 focus:py-2 focus:text-aurum-100">
    <?= h(t($t, $lang, 'skip')) ?>
  </a>

  <header class="sticky top-0 z-40 border-b border-white/5 bg-noir-950/75 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6">
      <a href="#" class="group flex items-center gap-3">
        <div class="grid h-10 w-10 place-items-center rounded-xl border border-aurum-400/20 bg-noir-900 shadow-gold">
          <span class="font-semibold tracking-widest gold-text">AN</span>
        </div>
        <div class="leading-tight">
          <div class="text-sm font-semibold tracking-[0.22em] text-aurum-100/90"><?= h($brand['name']) ?></div>
          <div class="text-xs text-zinc-400"><?= h($brand['tagline']) ?></div>
        </div>
      </a>
      <nav class="hidden items-center gap-6 text-sm text-zinc-300 md:flex">
        <a class="hover:text-aurum-100" href="#features"><?= h(t($t, $lang, 'nav_features')) ?></a>
        <a class="hover:text-aurum-100" href="#notes"><?= h(t($t, $lang, 'nav_notes')) ?></a>
        <a class="hover:text-aurum-100" href="#pricing"><?= h(t($t, $lang, 'nav_pricing')) ?></a>
        <a class="hover:text-aurum-100" href="#faq"><?= h(t($t, $lang, 'nav_faq')) ?></a>
      </nav>
      <div class="flex items-center gap-2">
        <div class="hidden items-center gap-1 rounded-xl border border-white/10 bg-noir-900/60 p-1 md:flex" aria-label="Language switch">
          <a href="<?= h(lang_url('th')) ?>" class="<?= $lang === 'th' ? 'bg-noir-950/70 border-aurum-400/25' : 'border-transparent' ?> inline-flex items-center gap-2 rounded-lg border px-2.5 py-1.5 text-xs font-semibold text-zinc-100 hover:border-aurum-400/20" aria-label="<?= h(t($t, $lang, 'lang_th')) ?>">
            <?= flag_svg('th') ?>
            TH
          </a>
          <a href="<?= h(lang_url('en')) ?>" class="<?= $lang === 'en' ? 'bg-noir-950/70 border-aurum-400/25' : 'border-transparent' ?> inline-flex items-center gap-2 rounded-lg border px-2.5 py-1.5 text-xs font-semibold text-zinc-100 hover:border-aurum-400/20" aria-label="<?= h(t($t, $lang, 'lang_en')) ?>">
            <?= flag_svg('en') ?>
            EN
          </a>
        </div>
        <a href="#pricing" class="hidden rounded-xl border border-aurum-400/25 bg-noir-900 px-4 py-2 text-sm font-medium text-aurum-100 hover:border-aurum-400/45 md:inline-flex">
          <?= h($brand['cta_secondary'][$lang]) ?>
        </a>
        <a href="#order" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-b from-aurum-200 to-aurum-500 px-4 py-2 text-sm font-semibold text-noir-950 shadow-gold hover:from-aurum-100 hover:to-aurum-400 focus:outline-none focus:ring-2 focus:ring-aurum-200/40">
          <span><?= h($brand['cta_primary'][$lang]) ?></span>
          <span aria-hidden="true">→</span>
        </a>
      </div>
    </div>
  </header>

  <main id="content">
    <section class="noise relative overflow-hidden">
      <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 left-1/2 h-[520px] w-[520px] -translate-x-1/2 rounded-full bg-aurum-300/10 blur-3xl"></div>
        <div class="absolute -bottom-40 right-[-120px] h-[520px] w-[520px] rounded-full bg-aurum-500/10 blur-3xl"></div>
      </div>
      <div class="mx-auto grid max-w-6xl grid-cols-1 gap-10 px-4 py-12 sm:px-6 md:grid-cols-2 md:gap-12 md:py-16">
        <div class="relative">
          <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-noir-900/60 px-3 py-1 text-xs text-zinc-300">
            <span class="h-2 w-2 rounded-full bg-aurum-300"></span>
            <?= h(t($t, $lang, 'pill')) ?>
          </div>
          <h1 class="mt-5 text-4xl font-semibold tracking-tight sm:text-5xl">
            <span class="gold-text"><?= h($brand['product']) ?></span><br>
            <span class="text-zinc-100"><?= h(t($t, $lang, 'hero_headline')) ?></span>
          </h1>
          <p class="mt-5 max-w-xl text-base leading-relaxed text-zinc-300">
            <?= h(t($t, $lang, 'hero_desc')) ?>
          </p>

          <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a href="#order" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-b from-aurum-200 to-aurum-500 px-5 py-3 text-sm font-semibold text-noir-950 shadow-gold hover:from-aurum-100 hover:to-aurum-400 focus:outline-none focus:ring-2 focus:ring-aurum-200/40 sm:w-auto">
              <?= icon_svg('spark', 'h-5 w-5') ?>
              <?= h($brand['cta_primary'][$lang]) ?>
            </a>
            <a href="#features" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/10 bg-noir-900/70 px-5 py-3 text-sm font-semibold text-zinc-100 hover:border-aurum-400/30 sm:w-auto">
              <?= icon_svg('shield', 'h-5 w-5 text-aurum-200') ?>
              <?= h(t($t, $lang, 'hero_guarantee')) ?>
            </a>
          </div>

          <div class="mt-8 grid grid-cols-3 gap-3">
            <div class="rounded-2xl border border-white/10 bg-noir-900/60 p-4">
              <div class="text-xs text-zinc-400"><?= h(t($t, $lang, 'kpi_sat')) ?></div>
              <div class="mt-1 text-lg font-semibold"><span class="gold-text">4.9</span> / 5</div>
            </div>
            <div class="rounded-2xl border border-white/10 bg-noir-900/60 p-4">
              <div class="text-xs text-zinc-400"><?= h(t($t, $lang, 'kpi_last')) ?></div>
              <div class="mt-1 text-lg font-semibold"><span class="gold-text">6–10</span> <?= h(t($t, $lang, 'kpi_hours')) ?></div>
            </div>
            <div class="rounded-2xl border border-white/10 bg-noir-900/60 p-4">
              <div class="text-xs text-zinc-400"><?= h(t($t, $lang, 'kpi_for')) ?></div>
              <div class="mt-1 text-lg font-semibold"><span class="gold-text">Unisex</span></div>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="relative mx-auto aspect-[4/5] w-full max-w-md overflow-hidden rounded-[2rem] border border-aurum-400/20 bg-gradient-to-b from-noir-800 to-noir-950 shadow-gold">
            <div class="absolute inset-0 opacity-90">
              <div class="absolute left-6 top-6 h-36 w-36 rounded-full bg-aurum-300/20 blur-2xl"></div>
              <div class="absolute bottom-0 right-0 h-56 w-56 rounded-full bg-aurum-500/15 blur-3xl"></div>
            </div>
            <div class="relative flex h-full flex-col justify-between p-7">
              <div>
                <div class="text-xs tracking-[0.22em] text-aurum-100/80">LIMITED EDITION</div>
                <div class="mt-2 text-2xl font-semibold"><?= h($brand['product']) ?></div>
                <div class="mt-1 text-sm text-zinc-400">50 ml • EDP</div>
              </div>
              <div class="rounded-2xl border border-white/10 bg-noir-900/60 p-5">
                <div class="flex items-start justify-between gap-4">
                  <div>
                    <div class="text-xs text-zinc-400"><?= h(t($t, $lang, 'card_price_label')) ?></div>
                    <div class="mt-1 text-3xl font-semibold">
                      <span class="gold-text"><?= h($brand['currency']) ?><?= h(format_price((int)$brand['price'])) ?></span>
                    </div>
                    <div class="mt-2 text-xs text-zinc-400"><?= h(t($t, $lang, 'card_includes')) ?></div>
                  </div>
                  <div class="grid h-11 w-11 place-items-center rounded-xl border border-aurum-400/20 bg-noir-950">
                    <?= icon_svg('drop', 'h-6 w-6 text-aurum-200') ?>
                  </div>
                </div>
                <div class="mt-4 flex items-center gap-2 text-xs text-zinc-300">
                  <span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-noir-950/60 px-2 py-1">
                    <?= icon_svg('shield', 'h-4 w-4 text-aurum-200') ?>
                    <?= h(t($t, $lang, 'badge_auth')) ?>
                  </span>
                  <span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-noir-950/60 px-2 py-1">
                    <?= icon_svg('truck', 'h-4 w-4 text-aurum-200') ?>
                    <?= h(t($t, $lang, 'badge_fast')) ?>
                  </span>
                  <span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-noir-950/60 px-2 py-1">
                    <?= icon_svg('leaf', 'h-4 w-4 text-aurum-200') ?>
                    <?= h(t($t, $lang, 'badge_clean')) ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <p class="mt-4 text-center text-xs text-zinc-500"><?= h(t($t, $lang, 'mock_note')) ?></p>
        </div>
      </div>
    </section>

    <section id="features" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
      <div class="flex items-end justify-between gap-6">
        <div>
          <div class="text-xs tracking-[0.22em] text-aurum-100/80">WHY YOU'LL LOVE IT</div>
          <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'why_title')) ?></h2>
          <p class="mt-2 max-w-2xl text-sm leading-relaxed text-zinc-300">
            <?= h(t($t, $lang, 'why_desc')) ?>
          </p>
        </div>
      </div>

      <div class="mt-7 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <?php foreach ($highlights as $hItem): ?>
          <div class="rounded-3xl border border-white/10 bg-noir-900/50 p-5 hover:border-aurum-400/25">
            <div class="flex items-start gap-3">
              <div class="grid h-11 w-11 place-items-center rounded-2xl border border-aurum-400/20 bg-noir-950">
                <?= icon_svg((string)$hItem['icon'], 'h-6 w-6 text-aurum-200') ?>
              </div>
              <div>
                <div class="text-base font-semibold"><?= h((string)$hItem['title']) ?></div>
                <div class="mt-1 text-sm leading-relaxed text-zinc-300"><?= h((string)$hItem['desc']) ?></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="notes" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
      <div class="rounded-[2.25rem] border border-aurum-400/15 bg-gradient-to-b from-noir-900 to-noir-950 p-6 shadow-gold sm:p-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center">
          <div>
            <div class="text-xs tracking-[0.22em] text-aurum-100/80">SCENT PYRAMID</div>
            <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'scent_title')) ?></h2>
            <p class="mt-2 text-sm leading-relaxed text-zinc-300">
              <?= h(t($t, $lang, 'scent_desc')) ?>
            </p>

            <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
              <div class="rounded-2xl border border-white/10 bg-noir-950/50 p-4">
                <div class="flex items-center gap-2 text-sm font-semibold">
                  <?= icon_svg('spark', 'h-5 w-5 text-aurum-200') ?>
                  <?= h(t($t, $lang, 'feel_tone')) ?>
                </div>
                <div class="mt-2 flex flex-wrap gap-2 text-xs">
                  <span class="rounded-full border border-white/10 bg-noir-900/70 px-3 py-1 text-zinc-200">Clean luxury</span>
                  <span class="rounded-full border border-white/10 bg-noir-900/70 px-3 py-1 text-zinc-200">Warm amber</span>
                  <span class="rounded-full border border-white/10 bg-noir-900/70 px-3 py-1 text-zinc-200">Soft woody</span>
                </div>
              </div>
              <div class="rounded-2xl border border-white/10 bg-noir-950/50 p-4">
                <div class="flex items-center gap-2 text-sm font-semibold">
                  <?= icon_svg('clock', 'h-5 w-5 text-aurum-200') ?>
                  <?= h(t($t, $lang, 'tips_title')) ?>
                </div>
                <ul class="mt-2 space-y-1 text-xs text-zinc-300">
                  <li><?= h(t($t, $lang, 'tip1')) ?></li>
                  <li><?= h(t($t, $lang, 'tip2')) ?></li>
                  <li><?= h(t($t, $lang, 'tip3')) ?></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <?php foreach ($notes as $row): ?>
              <div class="rounded-3xl border border-white/10 bg-noir-950/35 p-5">
                <div class="text-xs tracking-[0.22em] text-aurum-100/80"><?= h((string)$row['tier']) ?></div>
                <div class="mt-3 space-y-2">
                  <?php foreach ($row['items'] as $it): ?>
                    <div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-noir-900/60 px-4 py-2">
                      <span class="text-sm text-zinc-100"><?= h((string)$it) ?></span>
                      <span class="text-xs text-aurum-100/80">•</span>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-[2.25rem] border border-white/10 bg-noir-900/50 p-6 sm:p-8">
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="text-xs tracking-[0.22em] text-aurum-100/80">SPECIFICATIONS</div>
              <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'spec_title')) ?></h2>
              <p class="mt-2 text-sm text-zinc-300"><?= h(t($t, $lang, 'spec_desc')) ?></p>
            </div>
            <div class="grid h-12 w-12 place-items-center rounded-2xl border border-aurum-400/20 bg-noir-950">
              <?= icon_svg('shield', 'h-7 w-7 text-aurum-200') ?>
            </div>
          </div>
          <dl class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
            <?php foreach ($specs as $s): ?>
              <div class="rounded-2xl border border-white/10 bg-noir-950/35 p-4">
                <dt class="text-xs text-zinc-400"><?= h((string)$s['k']) ?></dt>
                <dd class="mt-1 text-sm font-medium text-zinc-100"><?= h((string)$s['v']) ?></dd>
              </div>
            <?php endforeach; ?>
          </dl>
        </div>

        <div class="rounded-[2.25rem] border border-white/10 bg-noir-900/50 p-6 sm:p-8">
          <div class="text-xs tracking-[0.22em] text-aurum-100/80">REVIEWS</div>
          <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'rev_title')) ?></h2>
          <p class="mt-2 text-sm text-zinc-300"><?= h(t($t, $lang, 'rev_desc')) ?></p>

          <div class="mt-6 space-y-4">
            <?php foreach ($testimonials as $t): ?>
              <figure class="rounded-3xl border border-white/10 bg-noir-950/35 p-5">
                <div class="flex items-start justify-between gap-4">
                  <div>
                    <div class="text-sm font-semibold text-zinc-100"><?= h((string)$t['name']) ?></div>
                    <div class="text-xs text-zinc-400"><?= h((string)$t['role']) ?></div>
                  </div>
                  <div class="flex items-center gap-0.5" aria-label="คะแนนรีวิว">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                      <span class="<?= $i <= (int)$t['rating'] ? 'text-aurum-300' : 'text-white/15' ?>">★</span>
                    <?php endfor; ?>
                  </div>
                </div>
                <blockquote class="mt-3 text-sm leading-relaxed text-zinc-200/90">
                  “<?= h((string)$t['quote']) ?>”
                </blockquote>
              </figure>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <section id="pricing" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-[2.25rem] border border-aurum-400/15 bg-gradient-to-b from-noir-900 to-noir-950 p-6 shadow-gold sm:p-8">
          <div class="text-xs tracking-[0.22em] text-aurum-100/80">BEST VALUE</div>
          <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'best_title')) ?></h2>
          <p class="mt-2 text-sm text-zinc-300"><?= h(t($t, $lang, 'best_desc')) ?></p>

          <div class="mt-6 rounded-3xl border border-white/10 bg-noir-950/40 p-6">
            <div class="flex items-end justify-between gap-4">
              <div>
                <div class="text-sm font-semibold"><?= h($brand['product']) ?></div>
                <div class="mt-1 text-xs text-zinc-400">แพ็กพรีเมียม + คู่มือการฉีด</div>
              </div>
              <div class="text-right">
                <div class="text-xs text-zinc-400"><?= h(t($t, $lang, 'price_today')) ?></div>
                <div class="text-3xl font-semibold"><span class="gold-text"><?= h($brand['currency']) ?><?= h(format_price((int)$brand['price'])) ?></span></div>
              </div>
            </div>

            <ul class="mt-5 space-y-2 text-sm text-zinc-200">
              <li class="flex gap-2">
                <span class="mt-0.5 text-aurum-200">✓</span>
                <span><?= h(t($t, $lang, 'li_ship')) ?></span>
              </li>
              <li class="flex gap-2">
                <span class="mt-0.5 text-aurum-200">✓</span>
                <span><?= h(t($t, $lang, 'li_cod')) ?></span>
              </li>
              <li class="flex gap-2">
                <span class="mt-0.5 text-aurum-200">✓</span>
                <span><?= h(t($t, $lang, 'li_return')) ?></span>
              </li>
            </ul>

            <a href="#order" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-b from-aurum-200 to-aurum-500 px-5 py-3 text-sm font-semibold text-noir-950 shadow-gold hover:from-aurum-100 hover:to-aurum-400 focus:outline-none focus:ring-2 focus:ring-aurum-200/40">
              <?= icon_svg('truck', 'h-5 w-5') ?>
              <?= h($brand['cta_primary'][$lang]) ?>
            </a>
            <p class="mt-3 text-center text-xs text-zinc-500"><?= h(t($t, $lang, 'order_hint')) ?></p>
          </div>
        </div>

        <div id="order" class="rounded-[2.25rem] border border-white/10 bg-noir-900/50 p-6 sm:p-8">
          <div class="text-xs tracking-[0.22em] text-aurum-100/80">ORDER</div>
          <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'order_title')) ?></h2>
          <p class="mt-2 text-sm text-zinc-300"><?= h(t($t, $lang, 'order_desc')) ?></p>

          <form class="mt-6 space-y-4" method="post" action="">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span class="text-xs text-zinc-400"><?= h(t($t, $lang, 'name_label')) ?></span>
                <input name="full_name" required class="mt-2 w-full rounded-2xl border border-white/10 bg-noir-950/40 px-4 py-3 text-sm text-zinc-100 placeholder:text-zinc-600 focus:border-aurum-400/35 focus:outline-none focus:ring-2 focus:ring-aurum-200/20" placeholder="<?= h(t($t, $lang, 'name_ph')) ?>" />
              </label>
              <label class="block">
                <span class="text-xs text-zinc-400"><?= h(t($t, $lang, 'phone_label')) ?></span>
                <input name="phone" inputmode="tel" required class="mt-2 w-full rounded-2xl border border-white/10 bg-noir-950/40 px-4 py-3 text-sm text-zinc-100 placeholder:text-zinc-600 focus:border-aurum-400/35 focus:outline-none focus:ring-2 focus:ring-aurum-200/20" placeholder="<?= h(t($t, $lang, 'phone_ph')) ?>" />
              </label>
            </div>
            <label class="block">
              <span class="text-xs text-zinc-400"><?= h(t($t, $lang, 'addr_label')) ?></span>
              <textarea name="address" required rows="3" class="mt-2 w-full resize-none rounded-2xl border border-white/10 bg-noir-950/40 px-4 py-3 text-sm text-zinc-100 placeholder:text-zinc-600 focus:border-aurum-400/35 focus:outline-none focus:ring-2 focus:ring-aurum-200/20" placeholder="<?= h(t($t, $lang, 'addr_ph')) ?>"></textarea>
            </label>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span class="text-xs text-zinc-400"><?= h(t($t, $lang, 'qty_label')) ?></span>
                <select name="qty" class="mt-2 w-full rounded-2xl border border-white/10 bg-noir-950/40 px-4 py-3 text-sm text-zinc-100 focus:border-aurum-400/35 focus:outline-none focus:ring-2 focus:ring-aurum-200/20">
                  <option value="1"><?= h(t($t, $lang, 'qty1')) ?></option>
                  <option value="2"><?= h(t($t, $lang, 'qty2')) ?></option>
                  <option value="3"><?= h(t($t, $lang, 'qty3')) ?></option>
                </select>
              </label>
              <label class="block">
                <span class="text-xs text-zinc-400"><?= h(t($t, $lang, 'pay_label')) ?></span>
                <select name="pay" class="mt-2 w-full rounded-2xl border border-white/10 bg-noir-950/40 px-4 py-3 text-sm text-zinc-100 focus:border-aurum-400/35 focus:outline-none focus:ring-2 focus:ring-aurum-200/20">
                  <option value="cod"><?= h(t($t, $lang, 'pay_cod')) ?></option>
                  <option value="transfer"><?= h(t($t, $lang, 'pay_transfer')) ?></option>
                </select>
              </label>
            </div>
            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-b from-aurum-200 to-aurum-500 px-5 py-3 text-sm font-semibold text-noir-950 shadow-gold hover:from-aurum-100 hover:to-aurum-400 focus:outline-none focus:ring-2 focus:ring-aurum-200/40">
              <?= icon_svg('spark', 'h-5 w-5') ?>
              <?= h(t($t, $lang, 'submit')) ?>
            </button>
            <p class="text-xs text-zinc-500">
              <?= h(t($t, $lang, 'order_note')) ?>
            </p>
          </form>
        </div>
      </div>
    </section>

    <section id="faq" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
      <div class="rounded-[2.25rem] border border-white/10 bg-noir-900/50 p-6 sm:p-8">
        <div class="text-xs tracking-[0.22em] text-aurum-100/80">FAQ</div>
        <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'faq_title')) ?></h2>
        <p class="mt-2 text-sm text-zinc-300"><?= h(t($t, $lang, 'faq_desc')) ?></p>

        <div class="mt-6 space-y-3">
          <?php foreach ($faqs as $f): ?>
            <details class="group rounded-3xl border border-white/10 bg-noir-950/35 p-5">
              <summary class="flex cursor-pointer list-none items-center justify-between gap-4">
                <span class="text-sm font-semibold text-zinc-100"><?= h((string)$f['q']) ?></span>
                <span class="grid h-9 w-9 place-items-center rounded-2xl border border-white/10 bg-noir-900/70 text-aurum-200 group-open:rotate-45 transition">
                  +
                </span>
              </summary>
              <div class="mt-3 text-sm leading-relaxed text-zinc-300">
                <?= h((string)$f['a']) ?>
              </div>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-14 sm:px-6">
      <div class="rounded-[2.5rem] border border-aurum-400/15 bg-gradient-to-b from-noir-900 to-noir-950 p-7 shadow-gold sm:p-10">
        <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
          <div>
            <div class="text-xs tracking-[0.22em] text-aurum-100/80">READY TO UPGRADE</div>
            <h2 class="mt-2 text-2xl font-semibold"><?= h(t($t, $lang, 'cta_title')) ?></h2>
            <p class="mt-2 max-w-2xl text-sm text-zinc-300"><?= h(t($t, $lang, 'cta_desc')) ?></p>
          </div>
          <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
            <a href="#order" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-b from-aurum-200 to-aurum-500 px-6 py-3 text-sm font-semibold text-noir-950 shadow-gold hover:from-aurum-100 hover:to-aurum-400 focus:outline-none focus:ring-2 focus:ring-aurum-200/40 sm:w-auto">
              <?= icon_svg('spark', 'h-5 w-5') ?>
              <?= h($brand['cta_primary'][$lang]) ?>
            </a>
            <a href="#features" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/10 bg-noir-950/35 px-6 py-3 text-sm font-semibold text-zinc-100 hover:border-aurum-400/25 sm:w-auto">
              <?= icon_svg('shield', 'h-5 w-5 text-aurum-200') ?>
              <?= h(t($t, $lang, 'cta_again')) ?>
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="border-t border-white/5 bg-noir-950">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
      <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-3">
          <div class="grid h-10 w-10 place-items-center rounded-xl border border-aurum-400/20 bg-noir-900">
            <span class="font-semibold tracking-widest gold-text">AN</span>
          </div>
          <div>
            <div class="text-sm font-semibold tracking-[0.22em] text-aurum-100/90"><?= h($brand['name']) ?></div>
            <div class="text-xs text-zinc-500"><?= h(t($t, $lang, 'footer_sub')) ?></div>
          </div>
        </div>
        <div class="text-xs text-zinc-500">
          © <?= date('Y') ?> <?= h($brand['name']) ?> • All rights reserved
        </div>
      </div>
    </div>
  </footer>

  <!-- Live chat widget -->
  <div
    id="livechat"
    class="fixed bottom-4 right-4 z-50"
    data-lang="<?= h($lang) ?>"
    data-csrf="<?= h($_SESSION['csrf']) ?>"
    data-t-error="<?= h(t($t, $lang, 'chat_error')) ?>"
    data-t-you="<?= h(t($t, $lang, 'chat_you')) ?>"
    data-t-agent="<?= h(t($t, $lang, 'chat_agent')) ?>"
  >
    <button
      id="chatFab"
      type="button"
      class="group inline-flex items-center gap-2 rounded-2xl bg-gradient-to-b from-aurum-200 to-aurum-500 px-4 py-3 text-sm font-semibold text-noir-950 shadow-gold hover:from-aurum-100 hover:to-aurum-400 focus:outline-none focus:ring-2 focus:ring-aurum-200/40"
      aria-controls="chatPanel"
      aria-expanded="false"
    >
      <span class="grid h-9 w-9 place-items-center rounded-xl bg-noir-950/15">
        <?= icon_svg('spark', 'h-5 w-5') ?>
      </span>
      <span class="hidden sm:inline"><?= h(t($t, $lang, 'chat_open')) ?></span>
      <span class="sm:hidden"><?= h(t($t, $lang, 'chat_title')) ?></span>
    </button>

    <div
      id="chatPanel"
      class="pointer-events-none invisible absolute bottom-[4.25rem] right-0 w-[92vw] max-w-sm translate-y-2 opacity-0 transition duration-200 sm:w-[420px]"
      role="dialog"
      aria-label="<?= h(t($t, $lang, 'chat_title')) ?>"
    >
      <div class="rounded-[1.75rem] border border-aurum-400/15 bg-noir-950/95 shadow-gold backdrop-blur">
        <div class="flex items-start justify-between gap-4 border-b border-white/5 px-5 py-4">
          <div class="flex items-start gap-3">
            <div class="grid h-11 w-11 place-items-center rounded-2xl border border-aurum-400/20 bg-noir-900">
              <?= icon_svg('shield', 'h-6 w-6 text-aurum-200') ?>
            </div>
            <div>
              <div class="text-sm font-semibold text-zinc-100"><?= h(t($t, $lang, 'chat_title')) ?></div>
              <div class="text-xs text-zinc-400"><?= h(t($t, $lang, 'chat_subtitle')) ?></div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <button id="chatClear" type="button" class="rounded-xl border border-white/10 bg-noir-900/60 px-3 py-2 text-xs font-semibold text-zinc-200 hover:border-aurum-400/20">
              <?= h(t($t, $lang, 'chat_clear')) ?>
            </button>
            <button id="chatClose" type="button" class="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-noir-900/60 text-zinc-200 hover:border-aurum-400/20" aria-label="Close">
              <span class="text-lg leading-none">×</span>
            </button>
          </div>
        </div>

        <div id="chatLog" class="chat-scrollbar max-h-[52vh] space-y-3 overflow-auto px-5 py-4 sm:max-h-[440px]"></div>

        <div class="border-t border-white/5 p-4">
          <form id="chatForm" class="flex items-end gap-2">
            <label class="sr-only" for="chatInput"><?= h(t($t, $lang, 'chat_placeholder')) ?></label>
            <textarea
              id="chatInput"
              rows="1"
              class="min-h-[44px] w-full resize-none rounded-2xl border border-white/10 bg-noir-900/60 px-4 py-3 text-sm text-zinc-100 placeholder:text-zinc-600 focus:border-aurum-400/35 focus:outline-none focus:ring-2 focus:ring-aurum-200/20"
              placeholder="<?= h(t($t, $lang, 'chat_placeholder')) ?>"
            ></textarea>
            <button
              id="chatSend"
              type="submit"
              class="inline-flex h-[44px] shrink-0 items-center justify-center gap-2 rounded-2xl bg-gradient-to-b from-aurum-200 to-aurum-500 px-4 text-sm font-semibold text-noir-950 shadow-gold hover:from-aurum-100 hover:to-aurum-400 focus:outline-none focus:ring-2 focus:ring-aurum-200/40"
            >
              <?= icon_svg('truck', 'h-5 w-5') ?>
              <span class="hidden sm:inline"><?= h(t($t, $lang, 'chat_send')) ?></span>
            </button>
          </form>
          <div class="mt-2 text-[11px] text-zinc-500">
            <?= h($brand['name']) ?> • Session chat (demo)
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function () {
      const root = document.getElementById('livechat');
      if (!root) return;

      const fab = document.getElementById('chatFab');
      const panel = document.getElementById('chatPanel');
      const closeBtn = document.getElementById('chatClose');
      const clearBtn = document.getElementById('chatClear');
      const log = document.getElementById('chatLog');
      const form = document.getElementById('chatForm');
      const input = document.getElementById('chatInput');

      const csrf = root.dataset.csrf || '';
      const tError = root.dataset.tError || 'Error';
      const tYou = root.dataset.tYou || 'You';
      const tAgent = root.dataset.tAgent || 'Admin';

      let isOpen = false;
      let lastRenderedCount = 0;

      function setOpen(next) {
        isOpen = next;
        fab.setAttribute('aria-expanded', String(isOpen));
        if (isOpen) {
          panel.classList.remove('invisible', 'opacity-0', 'translate-y-2', 'pointer-events-none');
          panel.classList.add('visible', 'opacity-100', 'translate-y-0', 'pointer-events-auto');
          fetchHistory(true);
          setTimeout(() => input && input.focus(), 50);
        } else {
          panel.classList.add('invisible', 'opacity-0', 'translate-y-2', 'pointer-events-none');
          panel.classList.remove('visible', 'opacity-100', 'translate-y-0', 'pointer-events-auto');
        }
      }

      function escapeHtml(s) {
        return (s || '').replace(/[&<>"']/g, (c) => ({
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        }[c]));
      }

      function bubble(msg) {
        const isUser = msg.role === 'user';
        const name = isUser ? tYou : tAgent;
        const time = new Date((msg.ts || 0) * 1000);
        const hh = String(time.getHours()).padStart(2, '0');
        const mm = String(time.getMinutes()).padStart(2, '0');
        const ts = (msg.ts ? `${hh}:${mm}` : '');

        return `
          <div class="flex ${isUser ? 'justify-end' : 'justify-start'}">
            <div class="max-w-[85%] rounded-3xl border ${isUser ? 'border-aurum-400/20 bg-gradient-to-b from-noir-900 to-noir-950' : 'border-white/10 bg-noir-900/55'} px-4 py-3">
              <div class="flex items-center justify-between gap-3">
                <div class="text-[11px] font-semibold ${isUser ? 'text-aurum-100/90' : 'text-zinc-200'}">${escapeHtml(name)}</div>
                <div class="text-[10px] text-zinc-500">${escapeHtml(ts)}</div>
              </div>
              <div class="mt-1 whitespace-pre-wrap text-sm leading-relaxed text-zinc-100">${escapeHtml(msg.text || '')}</div>
            </div>
          </div>
        `;
      }

      function render(messages, forceScroll) {
        if (!Array.isArray(messages)) messages = [];
        if (messages.length === lastRenderedCount && !forceScroll) return;
        lastRenderedCount = messages.length;
        log.innerHTML = messages.map(bubble).join('');
        if (forceScroll) log.scrollTop = log.scrollHeight;
      }

      async function fetchHistory(forceScroll) {
        try {
          const res = await fetch('?action=chat_history', { cache: 'no-store' });
          const data = await res.json();
          if (data && data.ok) {
            render(data.messages, forceScroll);
          }
        } catch (e) {
          // ignore
        }
      }

      async function sendMessage(text) {
        const body = new URLSearchParams();
        body.set('csrf', csrf);
        body.set('message', text);
        const res = await fetch('?action=chat_send', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body
        });
        const data = await res.json().catch(() => null);
        if (!data || !data.ok) throw new Error((data && data.error) || 'error');
        render(data.messages, true);
      }

      async function clearChat() {
        const body = new URLSearchParams();
        body.set('csrf', csrf);
        const res = await fetch('?action=chat_clear', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body
        });
        const data = await res.json().catch(() => null);
        if (data && data.ok) render(data.messages, true);
      }

      fab && fab.addEventListener('click', () => setOpen(!isOpen));
      closeBtn && closeBtn.addEventListener('click', () => setOpen(false));
      clearBtn && clearBtn.addEventListener('click', () => clearChat());
      document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && isOpen) setOpen(false); });

      form && form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const text = (input.value || '').trim();
        if (!text) return;
        input.value = '';
        try {
          await sendMessage(text);
        } catch (err) {
          input.value = text;
          alert(tError);
        }
      });

      // lightweight polling when open
      setInterval(() => {
        if (isOpen) fetchHistory(false);
      }, 2500);

      // auto-grow textarea
      input && input.addEventListener('input', () => {
        input.style.height = 'auto';
        input.style.height = Math.min(input.scrollHeight, 140) + 'px';
      });
    })();
  </script>
</body>
</html>
