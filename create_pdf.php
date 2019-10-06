<?php
    // tcpdf読み込み
    require_once('tcpdf\tcpdf.php');

    /*
        tcpdfインスタンスの生成
        $pdf = new TCPDF($orientation,$unit,$format,$unicode,$encoding,$diskcache);
        $orientation...用紙の向き(L:横,P:縦(デフォルト))
        $unit...単位(mm(デフォルト),pt,in)
        $format...用紙サイズ
        $unicode...unicodeであればtrue
        $encoding...文字コード(デフォルトはutf-8)
        $diskcache...ディスクキャッシュを使う場合にtrueとする
    */
    $tcpdf = new TCPDF("P","mm","A4",true,"UTF-8");

    $tcpdf->setPrintHeader(false);
    // $tcpdf->setPrintFooter(true);

    $tcpdf->setFooterMargin(20);

    // AddPageメソッド...新しいページの追加
    $tcpdf->AddPage();

    // SetFontメソッド...フォントの指定
    // 日本語を出力する場合、日本語フォントを指定しなければ文字化けする可能性がある
    /*
        第一引数...フォント名
        第二引数...フォントスタイル
        第三引数...フォントサイズ
    */

    // 値の受け取り
    $date = date('Y/m/d');
    $img = "./img/logo.png";
    // お客様（送り先）情報
    $customer_post_number = $_POST['post_number'];
    $customer_address = $_POST['address'];
    $customer_name = $_POST['name'];

    $sum = 10000;
    // 送り元情報
    $post_number = "160-0023";
    $address = "東京都新宿区西新宿1-7-3";
    $tel = "03-3344-xxxx";
    $fax = "03-3344-xxxx";


    // 商品情報
    $products = array();
    for($i = 1; $i < 6; $i++){
        $products[$i]["product_name"] = $_POST["product_name_".$i];
        $products[$i]["product_price"] = $_POST["product_price_".$i];
        $products[$i]["product_num"] = $_POST["product_num_".$i];
    }

    /*
        Cell( $w, $h, $txt, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign )
    */

    // 宛先
    $tcpdf->SetFont("kozminproregular", "", 7);
    $tcpdf->Cell(0,0,$date,0,0,"R",false,"",1,false,'T','B');
    $tcpdf->ln();
    $tcpdf->SetFont("kozminproregular", "", 10);
    $tcpdf->Cell(70,0,$customer_post_number,0,1,"L",false,"",1,false,'T','B');
    $tcpdf->SetFont("kozminproregular", "", 10);
    $tcpdf->Cell(70,0,$customer_address,0,1,"L",false,"",1,false,'T','B');
    $tcpdf->SetFont("kozminproregular", "", 20);
    $tcpdf->Cell(60,10,$customer_name,0,0,"L",false,"",4,false,'T','B');
    $tcpdf->SetFont("kozminproregular", "", 10);
    $tcpdf->Cell(10,10," 様",0,1,"L",false,"",1,false,'T','B');
    $tcpdf->Image('./img/logo.png',"180","15",20,20);

    $tcpdf->ln();

    // 送り主
    $tcpdf->SetFont("kozminproregular", "", 10);
    $tcpdf->Cell(140,0,"",0,0,"R",false,"",1,false,'T','B');
    $tcpdf->Cell(0,0,$post_number,0,0,"L",false,"",1,false,'T','B');
    $tcpdf->ln();
    $tcpdf->Cell(140,0,"",0,0,"R",false,"",1,false,'T','B');
    $tcpdf->Cell(0,0,$address,0,0,"L",false,"",1,false,'T','B');
    $tcpdf->ln();
    $tcpdf->Cell(140,0,"",0,0,"R",false,"",1,false,'T','B');
    $tcpdf->Cell(0,0,$tel,0,0,"L",false,"",1,false,'T','B');
    $tcpdf->ln();
    $tcpdf->Cell(140,0,"",0,0,"R",false,"",1,false,'T','B');
    $tcpdf->Cell(0,0,$fax,0,0,"L",false,"",1,false,'T','B');

    $tcpdf->ln();

    // 文
    $tcpdf->SetFont("kozminproregular", "", 10);
    $tcpdf->Cell(0,0,"下記の通り、領収いたしました。",0,0,"L",false,"",1,false,'T','B');

    $tcpdf->ln();

    // 合計金額
    $tcpdf->SetFont("kozminproregular", "", 10);
    $tcpdf->Cell(80,10,"合計金額",'B',0,"L",false,"",1,false,'T','B');
    $tcpdf->Cell(0,10,number_format($sum)." 円",'B',0,"L",false,"",1,false,'T','B');

    $tcpdf->ln();
    $tcpdf->ln(5);

    // 本文の作成
    $tcpdf->SetTextColor(255);
    $tcpdf->Cell(100,10,"内容",1,0,"C",true,"",1,false,'T','C');
    $tcpdf->Cell(20,10,"単価",1,0,"C",true,"",1,false,'T','C');
    $tcpdf->Cell(20,10,"数量",1,0,"C",true,"",1,false,'T','C');
    $tcpdf->Cell(40,10,"金額",1,0,"C",true,"",1,false,'T','C');
    $tcpdf->ln();

    $tcpdf->SetTextColor(0);
    // $products[$i]["product_name"] = $_POST["product_name_".$i];
    // $products[$i]["product_price"] = $_POST["product_price_".$i];
    // $products[$i]["product_num"] = $_POST["product_num_".$i];

    for($i=1; $i < 6; $i++){
        $tcpdf->Cell(100,10,$products[$i]["product_name"],1,0,"C",false,"",1,false,'T','C');
        $tcpdf->Cell(20,10,$products[$i]["product_price"],1,0,"C",false,"",1,false,'T','C');
        $tcpdf->Cell(20,10,$products[$i]["product_num"],1,0,"C",false,"",1,false,'T','C');
        $price = $products[$i]["product_price"] * $products[$i]["product_num"];
        $tcpdf->Cell(40,10,number_format($price),1,0,"C",false,"",1,false,'T','C');
        $tcpdf->ln();
    }

    $tcpdf->ln(5);
    // 小計
    $tcpdf->Cell(90,10,"",0,0,"C",false,"",1,false,'T','C');
     $tcpdf->SetTextColor(255);
    $tcpdf->Cell(30,10,"小計",1,0,"C",true,"",1,false,'T','C');
    $tcpdf->SetTextColor(0);
    $tcpdf->Cell(60,10,number_format(10000),1,0,"C",false,"",1,false,'T','C');
    $tcpdf->ln();
    // 消費税
    $tcpdf->Cell(90,10,"",0,0,"C",false,"",1,false,'T','C');
     $tcpdf->SetTextColor(255);
    $tcpdf->Cell(30,10,"消費税",1,0,"C",true,"",1,false,'T','C');
    $tcpdf->SetTextColor(0);
    $tcpdf->Cell(60,10,number_format(10000),1,0,"C",false,"",1,false,'T','C');
    
    $tcpdf->ln();
    $tcpdf->ln(5);

    // 備考欄
    $tcpdf->Cell(180,20,"備考",1,0,"L",false,"",1,false,'T','C');


    
    ob_end_clean();
    $tcpdf->Output("sample.pdf", "I");

    
?>