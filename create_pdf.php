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

    // $tcpdf->setPrintHeader(false);
    // $tcpdf->setPrintFooter(true);

    // $tcpdf->setFooterMargin(20);

    // AddPageメソッド...新しいページの追加
    $tcpdf->AddPage();

    // SetFontメソッド...フォントの指定
    // 日本語を出力する場合、日本語フォントを指定しなければ文字化けする可能性がある
    /*
        第一引数...フォント名
        第二引数...フォントスタイル
        第三引数...フォントサイズ
    */
    // $tcpdf->setFontSubsetting(false);
    $tcpdf->SetFont("kozminproregular", "", 10);

    // 本文の作成
    
    ob_end_clean();
    $tcpdf->Output("sample.pdf", "I");
    
?>