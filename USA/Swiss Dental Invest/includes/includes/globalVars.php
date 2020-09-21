<?php
  //PATHS
  define('PATH_DATABASE_BASE', 'connection/class.connection.php');
  define('PATH_DATABASE', '../'.PATH_DATABASE_BASE);
  define('PATH_DATABASE_INC', '../'.PATH_DATABASE);
  define('PATH_DESIGN_IMG', 'assets/img/designers/'); //nao vao ser estas de futuro, serve só de exemplo.
  define('PATH_PREORDER_IMG', 'assets/img/preorders/'); //nao vao ser estas de futuro, serve só de exemplo.
  define('PATH_BUNDLE_IMG', 'assets/img/bundles/'); //nao vao ser estas de futuro, serve só de exemplo.
  define('PATH_PRODUCT_IMG', 'assets/img/products/'); //nao vao ser estas de futuro, serve só de exemplo.
  define('PATH_STEPS_IMG', 'assets/img/steps/'); //nao vao ser estas de futuro, serve só de exemplo.
  define('PATH_LINE_IMG', 'assets/img/lines/'); //nao vao ser estas de futuro, serve só de exemplo.
  define('PATH_MATERIALS_IMG', 'assets/img/materials/'); //nao vao ser estas de futuro, serve só de exemplo.
  define('PATH_FAVICON', 'assets/img/icon');
  define('PATH_POPUP_IMG', 'assets/img/popup-campanhas/');
  define('PATH_EBOOKS', 'assets/ebooks');
  define('PATH_DOWNLOAD_LINK', 'includes/download_link.php');

  //SIZE IMAGES
  define('WIDTH_DESIGNER', 1920); //poderam não ser estas medidas de futuro assim como a info
  define('HEIGHT_DESIGNER', 1080); //poderam não ser estas medidas de futuro assim como a info
  define('WIDTH_PREORDER', 1920); //poderam não ser estas medidas de futuro assim como a info
  define('HEIGHT_PREORDER', 1080); //poderam não ser estas medidas de futuro assim como a info
  define('WIDTH_PRODUCT', 1920); //poderam não ser estas medidas de futuro assim como a info
  define('HEIGHT_PRODUCT', 1080); //poderam não ser estas medidas de futuro assim como a info

  //EMAIL
  define('MAIL_HOST', 'smtpout.secureserver.net');
  //define("MAIL_HOST","mail.infomaniak.com");
  define('MAIL_PORT', 587);
  define('MAIL_SMTP_AUTH_USER', 'noreply@swissdentalservices.com');
  define('MAIL_SMTP_AUTH_PW', 'famoSwiss2017!');
  define('MAIL_SMTP_SECURE', 'tls');
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  define('MAIL_DEBUG', 2);
  define('MAIL_EMAIL_FROM', 'noreply@swissdentalservices.com');
  define('MAIL_FROM_NAME', 'Swiss Dental Services');
  define('MAIL_DEBUGOUTPUT', 'html');

  //VALUES
  define('ADIP_ADMIN', 1); //nao vao ser estas de futuro, serve só de exemplo.
  define('ENC_KEY', 'sCU5bClSoUzHm862jqyh7Cw4Gns4nbxk'); //nao vao ser estas de futuro, serve só de exemplo.
  define('ENC_KEY_FRONT', 'E(H+KbPeShVmYq3t6w9z$C&F)J@NcQfT'); //nao vao ser estas de futuro, serve só de exemplo.

  //GALLERY FILTERS
  define('GALLERY_ALL', "'all'");
  define('GALLERY_IMAGE', "'image'");
  define('GALLERY_VIDEO', "'video'");
  define('GALLERY_YOUTUBE', "'youtube'");

  //FLAGs
  define('MEDIA_TESTIMONIALS', '0');
  define('MEDIA_EVENTS', '1');
  define('MEDIA_CAMPAIGNS', '2');
