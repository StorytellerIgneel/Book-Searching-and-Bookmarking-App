import React, { useState } from "react";
import axios from "axios";

const API_URL = "http://127.0.0.1:8000/test";

const App = () => {  
  const [response, setResponse] = useState("Click the button to fetch data");

  const fetchData = () => {
    console.log("Fetching data from:", API_URL);
    axios.get(API_URL)
      .then(res => {
        console.log("API Response:", res.data);
        setResponse(res.data.test);
      })
      .catch(error => console.error("API Error:", error));
  };

  return (
    <div>
      <h1>User List</h1>
      <button onClick={fetchData}>Fetch Data</button>
      <p>{response}</p>
    </div>
  );
};

export default App;
