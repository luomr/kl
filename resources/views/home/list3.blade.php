<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    <title>美素佳儿奶粉海淘-美素佳儿奶粉进口_多少钱_价格表-网易考拉海购</title>
    <link href="/adminpublic/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link rel="stylesheet" href="/css/list.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/list.js"></script>
</head>
<body>
  <!-- 顶部导航栏 -->
    @include('home/head')
    <!-- 中间列表 -->
    <div class="bodybox">
        <div class="m-search">
            <div class="resultwrap">
                <div class="tab">
                    
                <div class="tab3-6" id="tab3-11">
                   <ul>
                    
                      @foreach ($goods as $f)
                      @if ($f->status == 1)
                       <li>
                           <div class="tab3-7">
                               <div class="box_img"><a href="/details/{{$f->infotime}}" target="_blank"><img src="{{isset(explode(' ',$f->infoimg)[0])?explode(' ',$f->infoimg)[0]:$f->infoimg}}"></a></div>
                               <div class="tab3-8 tab3-9">
                                   <p class="p1">
                                      <span class="p11">
                                        <i>¥</i>{{$f->infosale}}
                                        </span>
                                      <span class="p12">¥<del>{{$f->infoprice}}</del></span>
                                   </p>
                                   <div class="tab3-10">
                                      <a class="title" title="{{$f->listname}} {{$f->valueattr}}  @foreach ($value as $va) @if ($f->infoattr2 == $va->id) {{$va->valueattr}} @endif @endforeach" href="/details/{{$f->infotime}}" target="_blank">
                                      <h2>{{$f->listname}} {{$f->valueattr}}
                                        @foreach ($value as $va)
                                              @if ($f->infoattr2 == $va->id) {{$va->valueattr}} @endif
                                        @endforeach</h2>
                                      </a>
                                   </div>
                                   <p class="p2">
                                      <span class="p21 p22">自营</span>
                                      <span class="p24 p23">券</span>
                                   </p>
                                   <p class="p3 p4">
                                      
                                   </p>
                                   <p class="p5">
                                     <span class="p51">网易考拉自营</span>
                                   </p>
                               </div>
                           </div>
                       </li>
                       @endif
                       @endforeach
                     
                   </ul>
                </div>

            </div>
        </div>

    </div>
  </div>

    <!-- 尾部部分 -->
    @include('home/foot')
</body>
</html>