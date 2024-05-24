@extends('layouts.front.front_main_layout')
@section('content')
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
                <li>会社概要</li>
            </ul>
        </div>
    </div>

    <article id="company">

        <section class="sec01">
            <div class="inner">
                <img src="{{ asset('front/img/company/img_company01.jpg')}}" alt="会社概要" class="wp-article-img">
            </div>
        </section>

        <section class="sec02">
            <div class="inner">
                <h3>会社概要</h3><p>COMPANY</p>
                <table class="table_company">
                    <tr>
                        <th>社　　　名</th>
                        <td>株式会社Lic（英文社名：Lic Co., Ltd.）</td>
                    </tr>
                    <tr>
                        <th>会   社 HP</th>
                        <td><a href="https://lic-8.com/" target="_blank">lic-8.com</a></td>
                    </tr>
                    <tr>
                        <th>役　　　員</th>
                        <td>代表取締役 小副川 祐貴</td>
                    </tr>
                    <tr>
                        <th>設　　　立</th>
                        <td>2019年2月</td>
                    </tr>
                    <tr>
                        <th>事 業 内 容</th>
                        <td>「ハコボウズ」の企画開発、運営</td>
                    </tr>
                    <tr>
                        <th>所　在　地</th>
                        <td>〒332-0001　埼玉県川口市朝日1-14-13 PMZ川口3F</td>
                    </tr>

                    <tr>
                        <th>メールアドレス</th>
                        <td>support@hakobozu.com</td>
                    </tr>
{{--                    <tr>--}}
{{--                        <th>取締役</th>--}}
{{--                        <td>綾部　葉子<br>峰松　貴之</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>監査役</th>--}}
{{--                        <td>綾部　光希</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>顧問弁護士</th>--}}
{{--                        <td>すいれん法律事務所<br>東　泰雄</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>主要取引銀行</th>--}}
{{--                        <td>西日本シティ銀行博多駅東支店<br>--}}
{{--                            福岡銀行博多駅東支店<br>--}}
{{--                            三菱UFJ銀行福岡中央支店--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>資　格　等</th>--}}
{{--                        <td>労働者派遣事業 許可番号 派 40-010237<br>--}}
{{--                            有料職業紹介事業 許可番号 40-ユ-010110<br>--}}
{{--                            福岡県競争入札参加資格 登録番号 90006798<br>--}}
{{--                            日本人材派遣協会 会員番号 1226<br>--}}
{{--                            民間人材サービス会社 受理番号 40-派-0088--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>コンプライアンス</th>--}}
{{--                        <td>--}}
{{--                            <ul class="compliance">--}}
{{--                                <li>・派遣事業に関する情報公開<a href="#" target="_blank" class="alpha"><img--}}
{{--                                            src="{{ asset('front/img/common/icon_pdf.png')}}" alt="PDF"></a></li>--}}
{{--                                <li>・個人情報保護方針<a href="#" target="_blank" class="alpha"><img--}}
{{--                                            src="{{ asset('front/img/common/icon_pdf.png')}}" alt="PDF"></a></li>--}}
{{--                                <li>・個人情報開示等手続<a href="#" target="_blank" class="alpha"><img--}}
{{--                                            src="{{ asset('front/img/common/icon_pdf.png')}}" alt="PDF"></a></li>--}}
{{--                                <li>・マージン率の公開<a href="#" target="_blank" class="alpha"><img--}}
{{--                                            src="{{ asset('front/img/common/icon_pdf.png')}}" alt="PDF"></a></li>--}}
{{--                            </ul>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                </table>
            </div>
        </section>

{{--        <section class="sec03">--}}
{{--            <div class="inner">--}}
{{--                <h3>事業所一覧</h3>--}}
{{--                <h4>福岡支社</h4>--}}
{{--                <dl>--}}
{{--                    <dt>--}}
{{--                        <p><span>管轄：</span>福岡地区 / 東京地区<br>--}}
{{--                            <span>住所：</span>〒812-0013　福岡市博多区博多駅東1-16-6<br>--}}
{{--                            <span>電話：</span>(092) 471-1034<br>--}}
{{--                            <span>FAX：</span>(092) 433-6198</p>--}}
{{--                        <p class="btn"><a--}}
{{--                                href="https://maps.google.com/maps?ll=33.5912,130.424524&amp;z=18&amp;t=m&amp;hl=ja&amp;gl=JP&amp;mapclient=embed&amp;cid=1420655738433507689"--}}
{{--                                target="_blank">大きな地図で見る&nbsp;&nbsp;&nbsp;&nbsp;&gt;</a></p>--}}
{{--                    </dt>--}}
{{--                    <dd>--}}
{{--                        <iframe--}}
{{--                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d830.8866777808145!2d130.42419272861355!3d33.59111666144648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x354191c93df41513%3A0x13b72eddfd731169!2z77yI5qCq77yJ44OG44Kj44O744Kq44O844O744Ko44K5!5e0!3m2!1sja!2sjp!4v1576502432332!5m2!1sja!2sjp"--}}
{{--                            width="640" height="320" frameborder="0" style="border:0;" allowfullscreen=""></iframe>--}}
{{--                    </dd>--}}
{{--                </dl>--}}
{{--                <h4>西九州支社</h4>--}}
{{--                <dl class="last">--}}
{{--                    <dt>--}}
{{--                        <p><span>管轄：</span>佐賀地区 / 久留米地区<br>--}}
{{--                            <span>住所：</span>〒841-0032　鳥栖市大正町787番地16-2F<br>--}}
{{--                            <span>電話：</span>(0942) 85-8460<br>--}}
{{--                            <span>FAX：</span>(0942) 85-8468</p>--}}
{{--                        <p class="btn-contact"><a--}}
{{--                                href="https://maps.google.com/maps?ll=33.374735,130.515079&amp;z=17&amp;t=m&amp;hl=ja&amp;gl=JP&amp;mapclient=embed&amp;q=2F%20%E3%80%92841-0032%20%E4%BD%90%E8%B3%80%E7%9C%8C%E9%B3%A5%E6%A0%96%E5%B8%82%E5%A4%A7%E6%AD%A3%E7%94%BA%EF%BC%97%EF%BC%98%EF%BC%97%E2%88%92%EF%BC%91%EF%BC%96"--}}
{{--                                target="_blank">大きな地図で見る&nbsp;&nbsp;&nbsp;&nbsp;&gt;</a></p>--}}
{{--                    </dt>--}}
{{--                    <dd>--}}
{{--                        <iframe--}}
{{--                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1400.8735714770341!2d130.51454061431062!3d33.37478255370082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3541a3a863950133%3A0x970b8b65a89b39cf!2z44CSODQxLTAwMzIg5L2Q6LOA55yM6bOl5qCW5biC5aSn5q2j55S677yX77yY77yX4oiS77yR77yWIDJG!5e0!3m2!1sja!2sjp!4v1576503690057!5m2!1sja!2sjp"--}}
{{--                            width="640" height="320" frameborder="0" style="border:0;" allowfullscreen=""></iframe>--}}
{{--                    </dd>--}}
{{--                </dl>--}}
{{--            </div>--}}
{{--        </section>--}}
    </article>
@endsection
