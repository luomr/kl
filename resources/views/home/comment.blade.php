<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的订单-个人中心-网易考拉海购</title>
    <link rel="stylesheet" href="/css/comment.css">
    <link href="/adminpublic/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <script src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/comment.js"></script>
    <script type="text/javascript" src="/js/layer/layer.js"></script>
</head>
<body>
     @include('home/head')
      <div class="com">
        @foreach ($res as $v)
          <div class="comment">
                <p class="comtit">
                  <span>订单编号：</span>
                  <strong>{{$v->ordernum}}</strong>
                  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                  <span>订单时间：</span>
                  <span>{{date('Y-m-d',$v->ordertime)}}</span>
                </p>
                <div class="comcon">
                  <div class="comimg">
                    <img src="{{$v->goods_img}}">
                    <p>{{$v->goods_name}}</p>
                  </div>
                  <div class="comform">
                    <form enctype="multipart/form-data" method="post" action="/comment/{{$v->goods_infotime}}">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                      <p class="tit">评论晒单：</p>
                      <textarea class="comtext" cols="20" rows="2" maxlength="200" name="comcontent">主人，商品这么赞，快码字表扬吧~图文并茂有机会获得额外积分。快来评论吧~
                      </textarea>
                      <p class="info"></p>
                      <input type="file" name="comimg[]" multiple>
                      <button class="sub" type="submit">发表评论</button>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
        </div>
      </div>
          <!-- 评论 -->
   </div>

    @include('home/foot')
    <script type="text/javascript">
        $(function(){
            $('.sub').click(function(){
              if($('.comtext').val() == ""){
                  $('.infor').html("评论点内容可能会更好");
                  return false;
              }
            })
        })
    </script>
</body>
</html>