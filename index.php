<?php 

  include('connection.php');


?>


<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>مصباح العلم </title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" >
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="./bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./aos/aos.css" rel="stylesheet">
  <link href="./glightbox/css/glightbox.min.css" rel="stylesheet">
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
/>
  <link href="./swiper/swiper-bundle.min.css" rel="stylesheet">-->
  
    <link rel="stylesheet" href="style.css" >
<body>
<!--<div id="loading"></div>-->
<!--navbar-->
 <headr class="header">
   <nav class="navbar navbar-expand-md fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand " href="admin_login.php">  مصباح العلم 
            <img src="./imag/logo.png" alt="" width="120" height="80">
            </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
      </button>       
   
       <div class=" collapse navbar-collapse " id="navbarTogglerDemo01">
        
        <ul  class="navbar-nav  mx-auto mt-5 " >
        <li class="nav-item ">
          <a class="nav-link active" aria-current="page" href="index.php"><button class="pa"> الصفحة الرئيسية</button> </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="index.php#about"><button class="pa1 ">من نحن؟</button></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="index.php#classt"><button class="pa2">الصفوف الدراسية</button></a>
        </li>
        <li class="nav-item">
       <a class="nav-link" href="index.php#testimonials"><button class="pa3">الكادر التدريسي </button></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php#students"><button class="pa4">الطلّاب المميزين</button></a>
        </li>
        <li class="nav-item">
         <a class="nav-link" href="index.php#contact"><button class="pa5">تواصل معنا</button></a>
        </li>
        </ul>
       <div class="d-flex">
              <ul class="navbar-nav ms-2  " >
                <li class="nav-item dropdown  ">
                    <a style="color:rgb(239, 232, 245);" class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <button class="pa6" >دخول</button>
                     </a>
                 <ul class="dropdown-menu " >
                       <li><a class="dropdown-item text-center " href="student_login_form.php">للطلاب</a></li>
                       <li><hr style="border-color:#399cc1;" class="dropdown-divider"></li>
                       <li><a class="dropdown-item text-center " href="teacher_login_form.php">للمعلّمين</a></li>
                 </ul>
                </li>
            </ul>
              </div>
      </div>
    </div>
    </nav> 
 </headr>
 <div></div>
 <!--end navbar-->

 <section class="box">
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="./imag/presntaion.mp4" type="video/mp4">
   </video>
   </section>
   
 <div></div>
 

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h4>من نحن؟</h4>
        <p>  مدرسة افتراضية حديثة تسعى لإيصال العلم من خلال وسائل مبتكرة ومتنوعة بالإضافة إلى أنشطة ترفيهية كالقصص المصوّرة وذلك من أجل تحفيز الطلّاب على التعلّم وإكمال مسيرتهم التعليمة بشكل ممتع   </p>
         </div>

      <div class="row  flex-row-reverse align-items-center" data-aos="fade-up" data-aos-delay="200">

        <div class="col-md-6">
          <div class="about-img">
            <img src="./imag/about.jpeg" class="img-fluid rounded-end" alt="">
          </div>
        </div>
             <!-- Tabs -->
          <div class="col-md-6">
          <ul class="nav nav-pills d-flex justify-content-between">
            <li><a class="nav-link active"  data-bs-toggle="pill" href="#tab1">رؤيتنا</a></li>
            <li><a class="nav-link"  data-bs-toggle="pill" href="#tab2">الوسائل المستخدمة</a></li>
            <li><a class="nav-link" data-bs-toggle="pill" href="#tab3">الشريحة المستهدفة </a></li>
           
          </ul><!-- End Tabs -->
          <hr style="color: rgb(1, 15, 15);">
          <!-- Tab Content -->
          <div class="tab-content">
            <div class="tab-pane fade show active" id="tab1">

              <p class="fst-italic"> رؤيتنا في مصباح العلم هي تفعيل التعلّم الذي يواكب التغيرات التكنولوجية الحديثة وذلك من خلال:</p>

              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>توفر أدوات تعزز التواصل بين المعلم والطالب</h4>
              </div>
              <p>حيث تتيح هذه المنظومة التعليمية إمكانية التواصل مع الطلاب بسهولة من خلال البريد الإلكتروني، بالإضافة إلى تحضير الواجبات والامتحانات والأنشطة عبر الانترنت.</p> 
              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>اكتساب الطالب مهارات جديدة</h4>
              </div>
              <p>
                من أهمها مهارة إدارة وتنظيم الوقت ومهارة التعامل مع التكنولوجيا الحديثة واستخدام التطبيقات المتطورة،واستمرار الأطفال في الدراسة دون الحاجة إلى الخروج من المنزل.
              </p>

              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>وجود كادر تدريسي متميز</h4>
              </div>
              <p> 
                   يتمكّن من إعطاء الدروس بطريقة شيقة والإجابة على استفسارات الطلاب بأسلوب مبسط، وأيضاَ لديهم خبرة باستخدام الأدوات التقنية الحديثة.             </p>

            </div><!-- End Tab 1 Content -->

            <div class="tab-pane fade show" id="tab2">

              <p class="fst-italic">
                هي كل الوسائل الحديثة التي يتم استخدامها من أجل العملية التعليمية ومنها:
              </p>

              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>الأجهزة الإلكترونية</h4>
              </div>
              <p>
               كالحاسوب والجوال والأجهزة اللوحية حيث كلٍّ منهما يمكّن المستخدم من الوصول إلى كافة فعاليات منظومة المدرسة وتحميل الكتاب الإلكتروني ، بالإضافة إلى كل بيانات التواصل  مع المدرسة.
              </p>

              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>البريد الإلكتروني</h4>
              </div>
              <p>
                وهو إحدى وسائل تبادل الرسائل بين الأشخاص بسرعة وكفاءة عالية، ويتم من خلال التواصل بين المعلم والطالب.
              </p>

              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>الكتاب الإلكتروني</h4>
              </div>
              <p>
                ويكون على شكل ملفات pdf يحتوي المنهاج كاملاً ومتاحاً للتحميل أو الطباعة أو التصفح المباشر مع روابط شروحات إضافية لإغناء المحتوى التعليمي.  
              </p>

            </div><!-- End Tab 2 Content -->
           <div class="tab-pane fade show" id="tab3">
              <p class="fst-italic">
                تتيح هذه المدرسة إمكانية التعلم لكافة الأطفال في المرحلة الابتدائية وهم:
              </p>

              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>الطلاب النظاميين</h4>
              </div>
              <p>      
              وهم الأطفال الذين تتطابق مرحلتهم الدراسية مع عمرهم ،أي الطفل الذي في الصف الأول بلغ من العمر 6 سنوات وهكذا.
              </p>
             <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4> الطلاب المنقطعين  عن التعليم</h4>
              </div>
              <p>
                وهم الطلاب الذين لم يلحقوا بالتعليم لظروفهم المختلفة مثل الظروف الاجتماعية والاقتصادية، وقد أصبح بإمكانهم الالتحاق بالصفوف الدراسية المتاحة بحسب تسجيلهم  لصف الذي يناسبهم. 
              </p>
              <div class="d-flex align-items-center mt-4">
                <i class="bi bi-check2"></i>
                <h4>الطلاب الناطقون باللغة العربية</h4>
              </div>
              <p>
               حيث أن المادة العلمية هي ذاتها، أي لاتتغير وتختلف بثوابتها العلمية وإنما يتغير أسلوب العرض والشرح، هذا يجعل أمام الطالب العربي فرصة للاستفادة من تلك المدرسة بحيث يتابع صف دراسي أو عدة صفوف حسب احتياجه
              </p>
            </div><!-- End Tab 3 Content -->
          </div>
        </div>
      </div>
      </div>
    </div>
  </section><!-------------- End About Section --------->

 <!---------start الصفوف الدراسية---------------->
 <section id="classt" class="classt">
  <div class="container  " data-aos="zoom-out">
    <div class="section1-header">
      <h4> الصفوف الدراسية </h4>
      <hr>
    </div>
    <div class=" row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 ">
      <?php
          $sql_class = mysqli_query($conn,"SELECT * FROM class" );
            while($row = $sql_class->fetch_assoc()){
      ?>
      <div class="col">
        <div class="card h-100" style="width: 18rem;">
          <img src="./imag/<?php echo $row['wpicture'] ?>" class="card-img-top h-100 " alt="...">
          <div class="card-body">
            <p class="card-text text-center"><?php echo $row['wname'] ?></p>
          </div>
        </div>
      </div>
      <?php } ?>
    </div> 

  </div>
 </section>
<!--==============end class==============================-->

<!--الكادر التدريسي-------------->
  <section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
      <div class="section3-header">
        <h4>الكادر التدريسي</h4>
      </div>
      <div class="testimonials-slider swiper">                 
        <div class="swiper-wrapper">
          <?php
              $sql_subject = mysqli_query($conn,"SELECT * FROM techer" );
                while($row = $sql_subject->fetch_assoc()){
          ?>          
           <div class="swiper-slide">                        
            <div class="testimonial-item">            
              <img src="./teacher/picture/<?php echo $row['wfile'] ?>" class="testimonial-img" alt="">
              
              <h4><?php echo $row['wname'] ?></h4>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p><?php echo $row['wbio'] ?></p>
            </div>
            
          </div><!-- End testimonial item -->
          <?php } ?>
        </div>      
        <div class="swiper-pagination"></div>        
      </div>   
    </div>
  </section>

<!--==========end الكادر التدريسي============-->
<!--start الطلاب المميزين-->
<section id="students" class="students">
<div class="container-xxl py-5" data-aos="fade-down">
  <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
          <h4 class="mb-3">الطلّاب المميزين</h4>
          <hr style="color:rgb(245, 95, 217);">
          <h6> لوحة الشرف</h6>
          
      </div>
      <div class="row g-4">
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="team-item position-relative">
                  <img class="img-fluid rounded-circle w-75" src="./imag/first.jpg" alt="">
                  <div class="team-text">
                      <h5>أميرة الشامي</h5>
                      <p>الصف: الأول</p>
                      
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
              <div class="team-item position-relative">
                  <img class="img-fluid rounded-circle w-75" src="./imag/seco.jpg" alt="">
                  <div class="team-text">
                      <h5>أحمد العوض</h5>
                      <p>الصف: الثاني</p>
                     
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
              <div class="team-item position-relative">
                  <img class="img-fluid rounded-circle w-75" src="./imag/three2.jpg" alt="">
                  <div class="team-text">
                      <h5>سميرة السبسبي</h5>
                      <p>الصف: الثالث</p>
                    
                  </div>
              </div>
          </div>
        
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
          <div class="team-item position-relative">
              <img class="img-fluid rounded-circle w-75" src="./imag/forth4.png" alt="">
              <div class="team-text">
                  <h5>يمان حجازي</h5>
                  <p>الصف: الرابع</p>
                
              </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
        <div class="team-item position-relative">
            <img class="img-fluid rounded-circle w-75" src="./imag/fife2.jpg" alt="">
            <div class="team-text">
                <h5>قصي المصري</h5>
                <p>الصف: الخامس </p>
           </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
      <div class="team-item position-relative">
          <img class="img-fluid rounded-circle w-75" src="./imag/six3.jpg" alt="">
          <div class="team-text">
              <h5>رزان المحمود</h5>
              <p>الصف: السادس  </p>
         </div>
      </div>
  </div>
      </div>
  </div>
</div>
</section>
<!-- Team End -->

<!--end الطلاب المميزين-->

<!--start تواصل معنا-->
<section id="contact" class="contact">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h4>تواصل معنا </h4>
      <hr>
         </div>

    <div class="row">

      <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
        <div class="info">
          <div class="address">
            <i class="bi bi-geo-alt"></i>
            <h6>الموقع:</h6>
            <p>سوريا، دمشق </p>
          </div>

          <div class="email">
            <i class="bi bi-envelope"></i>
            <h6>البريد الإلكتروني:</h6>
            <p>education.lamp6@gmail.com</p>
          </div>

          <div class="phone">
            <i class="bi bi-phone"></i>
            <h6>الهاتف:</h6>
            <p>00963011</p>
          </div>

        </div>

      </div>

      <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">

        <form action="forms/contact.php" method="POST" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="wname" class="form-control" id="name" placeholder="الاسم" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="wemail" id="email" placeholder="بريدك الإلكتروني" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="wsubject" id="subject" placeholder="الموضوع" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="wmessage" rows="5" placeholder="الرسالة" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">تم إرسال الرسالة، شكراً لك</div>
          </div>
          <div class="text-center"><button type="submit" name="submit" style="background-color: #29a3cf;">إرسال الرسالة</button></div>
        </form>

      </div>

    </div>
    <!-- End Contact Form -->

    </div>

  </div>
</section>
 <!--end تواصل معنا -->
 <!---->
 <footer id="footer" class="footer" >
  <div class="container-fluid mt-5 py-3">
    <div class="row">
      <div class="col-sm-6">
        <h5>المدرسة الحديثة الإلكترونية</h5>
        <p>مصباح العلم</p>
        <p>سوريا، دمشق</p>
      </div>
      <div class="col-sm-3">
        <div class="footer-info">
       <a href="index.php"><h6>الصفحة الرئيسية</h6></a>
       <a href="index.php#about"><h6>من نحن؟</h6></a> 
       <a href="index.php#classt"><h6>الصفوف الدراسية </h6></a>
  
        </div>
      </div>
      <div class="col-sm-3">
        <a href="index.php#testimonials"><h6> الكادر التدريسي</h6></a>
        <a href="index.php#students"><h6>الطلاب المميزين </h6></a>
       <a href="index.php#contact"><h6>  تواصل معنا <h6></a> 
       

      </div>
    </div>
  </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 
 <script src="./bootstrap/js/bootstrap.bundle.min.js"></script> 
 <script src="./aos/aos.js"></script>
 <script src="./glightbox/js/glightbox.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
 <script src="./swiper/swiper-bundle.min.js"></script> 
 <script src="./swiper/swiper-bundle.min.js.map"></script>
 <script src="main.js"></script>
 
</body>
</html>