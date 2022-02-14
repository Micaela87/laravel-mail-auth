export async function getDetails(id) {
    try {

        let response = await fetch('http://localhost:8000/api/posts/' + id);

        let responseToJson = await response.json();

        return responseToJson.data;

    } catch(err) {
        console.log(err);
    }
}