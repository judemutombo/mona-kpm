class Product extends React.Component{
    constructor(props){

        super(props)
        this.state = {number : 0}
        this.elements = null
        this.xhttp = null
    }
    componentDidMount(){
        this.load()
    }
    updateElement(){
        var results = JSON.parse(this.xhttp.responseText)
        if(!results[0]){
            this.elements =<p>{results[1]}</p> 
            this.setState(function(state,props){
                return {
                    number:0
                }
            })
        }else{
            this.elements =<table className="product-table">
                <thead>
                    <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Devise</th>
                    <th scope="col">Condition</th>
                    <th scope="state">State</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {results[1].map((element,key) =>
                        <tr key={key}>
                            <td data-label="Product">{element.name_}</td>
                            <td data-label="Price">{element.price}</td>
                            <td data-label="Devise">{element.devise}</td>
                            <td data-label="Condition">{element.condition}</td>
                            <td data-label="State">{element.state}</td>
                            <td data-label="">
                                <button onClick={this.deleteProduct.bind(this)} className="delete-product-tab" data-code={element.prod_code} data-position={key+1} >delete</button>
                            </td>
                        </tr>
                    )}
                </tbody>
            </table> 
            this.setState(function(state,props){
                return {
                    number:results[1].length,
                }
            })
        }
    }
    render(){
        return <React.Fragment>
           {this.elements}
        </React.Fragment>
    }
    load(){
        this.xhttp = new XMLHttpRequest()
        this.xhttp.addEventListener("load",this.updateElement.bind(this))
        this.xhttp.open("GET",'App/pont/getProduct.php',true)
        this.xhttp.send()
    }
    deleteProduct(e){
        var position = e.target.dataset.position
        var code = e.target.dataset.code
        const proto = this 
        document.querySelector(".glass").style.display="block"
        deleteProduct("Do you really want to delete this item?",position,code,function(){
            proto.load()
        })
        
    }
}


var onAddProduct = function(){
    window.productComponent.load()
}
ReactDOM.render(<Product ref={(element) => {window.productComponent = element}}/>,document.querySelector(".product-target"))

