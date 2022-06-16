import React from "react";
import "./Header.css";
import MenuIcon from "@material-ui/icons/Menu";
import { IconButton } from "@material-ui/core";

function Header() {
   return (
      <div className="header">
         <div className="header_info">
            <IconButton>
               <MenuIcon />
            </IconButton>
         </div>
         <div className="header_search"></div>
         <div className="header_right"></div>
      </div>
   );
}

export default Header;
