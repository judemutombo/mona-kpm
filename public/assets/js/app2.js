class ProductCard extends React.Component{
    constructor(props){
        console.log("render")
        super(props)
        this.state = {
            name:props.name,
            price:props.price,
            currency:props.currency,
            condition:props.condition,
            category :props.category,
            img:props.img,
            link:props.link,
            code:props.codeid
        }
        this.xhttp = null
    }
    componentDidMount(){
        this.load()
    }
    fillImage(e){
        var b64Response = btoa(this.xhttp.response);
        var link = this.state.category+"/"+this.state.code+"-"+this.state.name
        link = link.replace(/\s/g,"-");
        link = "product-detail/"+link
        var currency = null;
        switch(this.state.currency){
            case "USD" : currency = "$" 
                        break
            case "EUR" : currency ="€"
                        break
            case "GBP" : currency = "£"
                        break
            case "TRY" : currency = "₺"
                        break
            default  : return
        }
        this.setState(function(state,props){
            return {
                name:state.name,
                price:state.price,
                currency:currency,
                condition:state.condition,
                img:URL.createObjectURL(this.xhttp.response),
                link:link,
                code:state.codeid
            }
        })
    }
    load(){
        var params = "id="+this.state.code
        this.xhttp = new XMLHttpRequest()
        this.xhttp.addEventListener("load",this.fillImage.bind(this))
        this.xhttp.open("POST",'App/pont/getImage.php',true)
        this.xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        this.xhttp.responseType = "blob";
        this.xhttp.send(params)
    }
    render(){
        return <div className="colonne-3 colonne-sm-6 colonne-md-6">
                    <div className="carte">
                        <div className="carte-top-content">
                            <img className="carte-top-content-img" src={this.state.img} height="100%" width="100%"/>
                        </div>
                        <div className="carte-bottom-content">
                            <div className="carte-bottom-content-details">
                                <p><span >Price</span> : {this.state.currency+" "+this.state.price}</p>
                                <p><span>name</span> : {this.state.name}</p>
                                <p><span>Condition</span> : {this.state.condition}</p>
                            </div>
                            <div className="carte-bottom-content-button">
                            <a className="button-buy" href={this.state.link}>See item</a>
                            </div>
                        </div>
                    </div>
                </div>
    }
}
const ratio = .3;
const options = {
    root:null,
    rootMargin:"0px",
    threshold : ratio
};
const handleIntersect = function(entries,observer){
    entries.forEach(element => {
        if(element.intersectionRatio > ratio){
            window.ProductGroupComponent.load()
        }
    });
}
class ProductGroup extends React.Component{
    constructor(props){
        super(props)
        this.state={
            number:0,
            token:props.token,
            loader : false,
            type : props.type,
            lastKey : 1
        }
        this.elements = []
        this.xhttp = null
    }
    load(){
        var params = "limit="+this.state.number+"&token="+this.state.token+"&type="+this.state.type
        this.xhttp = new XMLHttpRequest()
        this.xhttp.addEventListener("load",this.fillElement.bind(this))
        this.xhttp.open("POST",'App/pont/productNavigation.php',true)
        this.xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        this.xhttp.send(params)
    }
    fillElement(){
        var results = JSON.parse(this.xhttp.responseText)
        if(!results[0]){
            this.elements +=<p>{results[1]}</p>
        }else{
            results[1].forEach((element,key) =>{
                this.elements.push(<ProductCard name={element.name_} price={element.price} currency={element.devise} condition={element.condition} img=" " link={""} key={key + this.state.lastKey} codeid={element.prod_code} category={element.category}/>
                )
            })
            if(!this.state.loader){
                var loader = document.createElement("div")
                loader.innerHTML = '<p>Loading...</p> &nbsp;'
                loader.innerHTML +='<div class="small-loader"></div>'
                loader.classList.add("pagination-loader")
                document.querySelector(".target").parentNode.appendChild(loader)
                var observer = new IntersectionObserver(handleIntersect,options)
                var elt = document.querySelector(".pagination-loader")
                observer.observe(elt);
            }
            this.setState(function(state,props){
                return {
                    number:state.number + 6,
                    token:props.token,
                    loader:true,
                    lastKey : state.lastKey+state.number + 6
                }
            })
        }
    }
    componentDidMount(){
        this.load()
    }
    render(){
        return  <React.Fragment>
                    {this.elements}
                </React.Fragment>
    }
}
var token = document.querySelector(".target").dataset.token
var type = document.querySelector(".target").dataset.type
ReactDOM.render(<ProductGroup ref={(element) => {window.ProductGroupComponent = element}} token={token} type={type} />,document.querySelector(".target"))