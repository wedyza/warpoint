function get_image(){
    axios.get('https://api.unsplash.com/photos/random?client_id=lD0KzIzoKVGdfanBdclwzv-mm535YJh_-wGk3LxPC0U&query=sneakers').catch((response) => console.log(response));
}