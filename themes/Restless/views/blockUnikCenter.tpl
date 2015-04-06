@if({{nbArticles}} > 0 && {{blockArticleActive}} == true)
<section id="RL_blockUnikCenter" {{classUnikCenter}}>
    @foreach(blockArticleContent as item)
    <figure>
        <img src="{{item.image}}" alt="" />
        <figcaption>
            <h3>{{item.title}}</h3>
            <p>{{item.postedBy}}</p>
            <a href="{{item.link}}">+</a>
        </figcaption>
    </figure>
    @endforeach
</section>
@endif