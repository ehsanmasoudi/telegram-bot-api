# شبیه سازی Bot Api Server تلگرام برای استفاده در سرورهای ایرانی   

![استفاده از هاست ایرانی برای ربات تلگرام](simulated-bot-api-server.jpg)
    
برای کشورهایی از جمله ایران که تلگرام در آنها سانسور و فیلتر شده، اگر هاست یا سرور شما در ایران قرار دارد، برای ارتباط با api تلگرام با مشکل مواجه خواهید شد. بهترین راه برای حل این مشکل استفاده از Bot Api Server خود تلگرام است که باید بر روی یک سرور خارج از کشور نصب کنید تا به صورت اختصاصی یک سرور api ربات داشته باشید.  
لینک راهنمای نصب: https://github.com/tdlib/telegram-bot-api
  

اما در این ریپازیتوری برای شما با زبان php کدی را آماده کرده ایم که اگر هاست خارج از کشور داشته باشید، با کمترین دردسر و هزینه میتوانید از آن استفاده کنید.  
کافیست یک سابدامین ساخته و فایل های این ریپازیتوری را در دایرکتوری آن آپلود کنید.  
متدهای مختلف تلگرام را میتوانید استفاده کنید:  
tapi.example.com/bot{token}/{Method}  

پشتیبانی از متدهای POST و GET  +  همچنین میتوانید دیتای ریکوست مدنظر را به صورت json و با هدر Content-Type: application/json ارسال کنید.  
  
همچنین برای دانلود فایل های کم حجم مثل تصاویر میتوانید مانند api تلگرام از این سرویس استفاده کنید:  
tapi.example.com/file/bot{token}/{path}  
  
برای استفاده در پروژه خود کافیست به جای api.telegram.org که Bot Api Server رسمی تلگرام است، tapi.example.com را که شبیه سازی شده از api تلگرام است را قرار دهید.  
  
طبق تست هایی که انجام شد، در کشور ما سانسورشیپ به صورت یکطرفه است، یعنی فقط ما به تلگرام دسترسی نداریم، اما تلگرام میتواند آپدیت ها و داده های ربات تلگرام را مستقیما به آدرس وبهوک که سرور آن در ایران است ارسال کند و با حذف واسطه، سرعت ربات افزایش پیدا کند. اما اگر در هر صورتی برای شما جوابگو نبود، در لاین 4 از فایل index.php ، مقدار Webhook را برابر با true قرار دهید تا وبهوک ربات بر روی api شبیه سازی شده روی هاست خارج از کشور شما، تنظیم شود و به طور کامل واسط بین سرور ایران و تلگرام قرار گیرد.  
  
در هر صورت بهترین راه، استفاده از سرور خارج از کشور است؛ اما به دلیل اختلالات گسترده اینترنت، لود شدن وبسایت با مشکلات متعددی روبرو میشود که بر سئو و تجربه کاربری اثر منفی دارد. ما در یک پروژه نیاز داشتیم که لاگ ها و رویدادهای وبسایت را به کانال تلگرام ارسال کنیم و بر آن شدیم که این پروژه ساده را طراحی کنیم تا از هاست ایران لاگ ها را به کانال تلگرام ارسال کنیم، و همچنین یک ربات تلگرام با استفاده نسبتا کم که سرعت خیلی در آن مطرح نیست، پیاده سازی کنیم. همچنین برای کارهای مرسوم خود نیز مثل متد setwebhook یا زمانی که روی لوکال هاست میخواهیم لاگ ها را ارسال کنیم، کمتر با مشکلات vpn دست و پنجه نرم میکنیم.  
  
انشاالله که مورد استفاده قرار گیرد.
