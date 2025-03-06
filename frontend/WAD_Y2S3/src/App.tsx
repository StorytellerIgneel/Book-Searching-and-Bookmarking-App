import React, { useState } from "react";
import axios from "axios";
import { HashRouter, Route, Routes } from "react-router-dom";
import {UserProvider} from "./contexts/UserContext";
import LoginPage from "./pages/LoginPage.jsx";
import TestingPage from "./pages/TestingPage.jsx";

function App() {
  return (
    <div>
      <UserProvider>
          <HashRouter>
              <Routes>
                {/* <Route path="/" element={<Layout />}>
                  <Route index element={<MainPage />} />
                  <Route path="/store" element={<StorePage />} />
                  <Route path="/store/:game_id" element={<ProductPage />} />
                  <Route path="/support" element={<Email />} />
                  <Route path="/cart" element={<CartPage />} />
                  <Route path="/profile" element={<ProfilePage />} />
                  <Route path="/faq" element={<FAQ/>}/>
                </Route> */}
                <Route path="/" element={<LoginPage/>} />
            </Routes>
          </HashRouter>
        </UserProvider>
    </div>
  );
}

// const App = () => {  
//   return (
//     <div>
//       <LoginPage/>
//     </div>
//   )
// };

export default App;
