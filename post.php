<?php

/**
 * post.php
 *
 * Bu betik direk olarak erişilebilir. functions.php'de yaptığınız gibi bir
 * kontrol eklemenize gerek yok.
 *
 * > Dikkat: Bu dosya hem direk çalıştırılabilir hem de `posts.php` dosyasında
 * > 1+ kez içe aktarılmış olabilir.
 *
 * Bu betik dosyası içerisinde functions.php'de yer alan fonksiyonları da kullanarak
 * aşağıdaki işlemleri gerçekleştirmenizi bekliyoruz.
 *
 * - $id değişkeni yoksa "1" değeri ile tanımlanmalı, daha önceden bu değişken
 * tanımlanmışsa değeri değiştirilmemeli. (Kontrol etmek için `isset`
 * (https://www.php.net/manual/en/function.isset.php) kullanılabilir.)
 * - $id için yapılan işlemin aynısı $title ve $type için de yapılmalı. (İstediğiniz
 * değerleri verebilirsiniz)
 * - Bir sonraki adımda ilgili içerik gösterilmeden önce bir div oluşturulmalı ve
 * bu div $type değerine göre arkaplan rengi almalıdır. (urgent=kırmızı,
 * warning=sarı, normal=arkaplan yok)
 * - `getPostDetails` fonksiyonu tetiklenerek ilgili içeriğin çıktısı gösterilmeli.
 */

 

include_once("functions.php");

if(!isset($posts)){ // Eğer yukarıda $posts isimli değişken tanımlanmadıysa aşağıdaki kodları çalıştırır

    $rand_post_count = getRandomPostCount(1, 15); // 1 ila 15 arasında rasgele integer sayı döndürür
    $posts = getLatestPosts($rand_post_count); // rasgele post sayı değerine göre son postları dizi olarak getirir
    
    
    foreach($posts as $id => $post){ 
        $id_arr[] = $id; // $posts dizisindeki tüm id değerlerini $id_arr dizisi ile yeni bir diziye ekle  
    }

    for($i=1; $i<10000; $i++) { // 1 ila 10000 sayısı aralığında  
        if(in_array($i,$id_arr)) { // eğer $i sayısı $id_arr dizisinde tanımlı ise,
           continue; // döngüyü bir sonraki değere iterate eder 
        } else { //değilse,
            $tmp = $i; // Geçici $tmp değişkenine $i değişkenini atar
            break; // döngüden çıkar.
        }
    }
    
    $id = $tmp; // $id değişkenine geçici $tmp değerini atar

    $my_post = []; // Tek bir post barındıracak olan dizi tanımlandı

    $my_post[$id] = [ 
        "title" => "Prototype Title ",
        "type" => "warning"
    ];

    $posts[] = $my_post; //$my_post adlı post u $posts dizisine ekler

    foreach($posts as $id => $post){ 
        if(!isset($post['title'])){ // Eğer posts array içerisindeki geçerli dizi değeri içerisinde $title değeri tanımlı değilse,
            $post['title'] = "Added Title"; // mevcut post dizisine 'title' değeri ekle
        }
        if(!isset($post['type'])){ // Eğer posts array içerisindeki geçerli dizi değeri içerisinde $type değeri tanımlı değilse,
            $post['type'] = "warning"; // mevcut post dizisine 'type' değeri ekle
        }
    }
    
    foreach($my_post as $id => $post){ 
    
        if($post['type'] =="urgent") { // $post dizisinde "type" değerine göre div içerisinde background-color stilini oluşturur
            echo "<div style = 'background-color:red' >";
        } elseif($post['type'] =="warning") {
            echo "<div style = 'background-color:yellow' >";
        } else {
            echo "<div>";
        }
        getPostDetails($id, $post['title']); // Verilen parametrelere göre ekrana post detaylarını getirir
        echo "</div>";
    }

}
else { // Eğer yukarıda $posts isimli değişken tanımlandıysa aşağıdaki kodları çalıştırır
    
    if(!isset($id)){

        foreach($posts as $id => $post){ 
            $id_arr[] = $id; // $posts dizisindeki tüm id değerlerini $id_arr dizisi ile yeni bir diziye ekle  
        }
    
        for($i=1; $i<10000; $i++) { // 1 ila 10000 sayısı aralığında  
             if(in_array($i,$id_arr)) { // eğer $i sayısı $id_arr dizisinde tanımlı ise,
                 continue; // devam et yani bir sonraki değere iterate eder 
        }    else { //değilse,
                 $tmp = $i; // Geçici $tmp değişkenine $i değişkenini atar
                 break; // döngüden çıkar.
        }
    }

    $id = $tmp; // $id değişkenine geçici $tmp değerini atar
}
    $post[$id] = [
        'title' => $post['title'],
        'type' => $post['type']
    ];

    
        if(!isset($post['title'])){ // Eğer posts array içerisindeki geçerli dizi değeri içerisinde $title değeri tanımlı değilse,
            $post['title'] = "Added Title"; // mevcut post dizisine 'title' değeri ekle
        }
        if(!isset($post['type'])){ // Eğer posts array içerisindeki geçerli dizi değeri içerisinde $type değeri tanımlı değilse,
            $post['type'] = "warning"; // mevcut post dizisine 'type' değeri ekle
        }
    

    // Eğer posts array i içerisindeki geçerli dizi değeri içerisinde $id değeri tanımlı değilse aşağıdaki kodları çalıştırır
    if($post['type'] == "urgent") { // $post dizisinde "type" değerine göre div içerisinde background-color stilini oluştur
        echo "<div style = 'background-color:red' >";
        
    } elseif($post['type'] == "warning") {
        echo "<div style = 'background-color:yellow' >";
    } else {
        echo "<div>";
    }
    getPostDetails($id, $post['title']); // Belirtilen $id ve $post['title] parametrelerine göre post içeriğini getirir
    echo "</div>";

}




