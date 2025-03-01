import React, { useEffect, useState } from 'react';
import axios from 'axios';

const API_URL = "http://127.0.0.1:8000/test";

// Define the user type
interface User {
  id: number;
  name: string;
  email: string;
}

const App = () => {  
  const [response, setResponse] = useState("response");

  useEffect(() => {
    console.log("Fetching data from:", API_URL); // Debug: Check if URL is corre 
    axios.get(API_URL)
      .then(response => {
        setResponse( response.data.test); // Debugging
      })
      .catch(error => console.error("API Error:", error));
  }, []);

  return (
    <div>
      <h1>User List</h1>
      <p>{response}</p>
    </div>
  );
};

export default App;
