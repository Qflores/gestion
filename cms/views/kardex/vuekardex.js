
 var app = new Vue({

	    el: '#app',
	    
	    productos: [], 
		articles: [],		
		filekardex: "",

	    data: {	    	
	    	productos: [], 
	    	articles: [],
	    	filekardex: ""
			
	    },
	    data(){
            return {
                articles: [],
                productos: [],
                filekardex: ""
            }
            
        },
        mounted() {
        	  
        },
        updated: function () {
		
		},
        methods:{


        	handleFileUpload: function(){
        		
        		this.filekardex = this.$refs.file.files[0];
        		//console.log(this.filekardex)
        		//console.log("cargando archivo")
        	},

        	 UploadFile: function(){  

        		let url = "controllers/kardex/upluadfile.php"

        		const formData = new FormData();
        			formData.append("file",this.filekardex)
                const config ={headers: {'Content-Type': 'multipart/form-data'}}

        			axios.post(url, formData, config)
        			.then(data=>data.data)
        			.then(res=>{
        				//console.log(res)
        			})
					.catch(err=>{
					  //console.log(err)
					 //console.log('FAILURE!!')
					});


        	},

            filedowload: function(){

                let url = "controllers/kardex/dowloadfile.php"
                let fordata = new FormData();
                    fordata.append("idus", "qflores")
                
                let config ={responseType:'blob'}

                    axios.post(url, fordata, config)
                    .then(response => {
                        this.download(response)
                    }).catch((error) => {
                        //console.log(error);
                    })

            },

            download: function(data){
                if (!data) {
                    return
                }
                let url = window.URL.createObjectURL(new Blob([data]))
                let link = document.createElement('a')
                link.style.display = 'none'
                link.href = url
                link.setAttribute('download', 'excel.xlsx')
                
                document.body.appendChild(link)
                link.click()

            }
        }
})//end vuew