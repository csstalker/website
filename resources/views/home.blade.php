@extends('layouts.master')

@section('main')
  <div class="row">
    <div class="col-xs-12 col-md-offset-2 col-md-8">
      <header>
        <h1 class="text-center">{{ $pageName }}</h1>
      </header>

      <section>
        <div class="panel panel-success">
          <div class="panel-heading">發文教學</div>
          <div class="panel-body">
            <ul>
              <li>當文章中有連結時，系統會用第一個連結當作欲分享的連結</li>
              <li>當文章中出現{{ $pageName }}的 hashtag 時，系統會自動在後方附上連結</li>
              <li>專案開源於 <a href="https://github.com/BePsvPT/Facebook-Anonymous-Publisher" target="_blank">Github</a></li>
            </ul>
          </div>
        </div>
      </section>

      <section>
        @include('components.form-errors')

        {!! Form::open(['route' => 'kobe', 'method' => 'POST', 'files' => true, 'role' => 'form', 'data-toggle' => 'validator']) !!}

        <div class="form-group">
          {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => '今天要靠北什麼？', 'maxlength' => 500, 'data-error' => '至少需要靠北點東西', 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-md-6">
            <div class="form-group">
              {!! Form::label('image', '圖片（可選）') !!}
              {!! Form::file('image', ['accept' => 'image/*']) !!}
              <p class="help-block">大小需小於 3 MB</p>
            </div>

            <div class="form-group">
              {!! Recaptcha::render() !!}
            </div>
          </div>

          <div class="col-xs-12 col-md-6">
            @unless(empty($application['ad-client']) || empty($application['ad-slot']))
              <section>
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="{{ $application['ad-client'] }}"
                     data-ad-slot="{{ $application['ad-slot'] }}"
                     data-ad-format="auto"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
              </section>
            @endunless
          </div>
        </div>

        <div class="form-group">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">服務條款及隱私政策</h3>
            </div>
            <div class="panel-body">
              <ol>
                <li>嚴禁發表任何違反中華民國法律之內容</li>
                <li>嚴禁發表任何違反新加坡法律之內容</li>
                <li>嚴禁發表任何違反 Facebook 社群使用規則之內容</li>
                <li>嚴禁指名道姓、透漏任何個資或隱私資訊</li>
                <li>請善用「x」取代敏感資訊，取代程度須達到不足以辨別當事者</li>
                <li>本網站是以即時上載發文的方式運作，對所有發文的真實性、完整性及立場等，不負任何法律責任。而一切發文之言論只代表發文者個人意見，並非本網站之立場，用戶不應信賴內容，並應自行判斷內容之真實性。於有關情形下，用戶應尋求專業意見(包含但不限於醫療、法律或投資等問題)。由於本網站受到「即時上載留言」運作方式所規限，故不能完全監察所有發文，若讀者發現有發文出現問題，請聯絡我們。本網站有權刪除任何發文及拒絕任何人士上載發文，同時亦有不刪除發文的權利。切勿撰寫粗言穢語、誹謗、渲染色情暴力或人身攻擊的言論，敬請自律。本網站保留一切法律權利。</li>
              </ol>

              {{--<pre>{{ $application['license'] }}</pre>--}}

              <div class="checkbox">
                <label>
                  {!! Form::checkbox('accept-license', true, null, ['data-error' => '您必須同意本站隱私條款', 'required']) !!}
                  <span>我同意並已詳細閱讀服務條款及隱私政策，並同意於按下送出按鈕後放棄對本網站所有法律追訴權</span>
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-block">送出</button>
        </div>

        {!! Form::close() !!}
      </section>

      @unless(empty($application['ga']))
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          ga('create', '{{ $application['ga'] }}', 'auto');
          ga('send', 'pageview');
        </script>
      @endunless
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).on('submit', 'form', function () {
      $('button.btn-success').attr('disabled', true)
    })
  </script>
@endpush
