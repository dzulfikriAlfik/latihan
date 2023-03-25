import React from "react";
import "./Header.css";
import MenuIcon from "@material-ui/icons/Menu";
import { IconButton } from "@material-ui/core";
import SearchIcon from "@material-ui/icons/Search";
import AppsIcon from "@material-ui/icons/Apps";
import Avatar from "@material-ui/core/Avatar";

function Header() {
   return (
      <div className="header">
         <div className="header_info" style={{ textAlign: "left" }}>
            <IconButton>
               <MenuIcon />
            </IconButton>
         </div>
         <div className="header_search" style={{ textAlign: "left" }}>
            <SearchIcon />
            <input type="text" name="search" id="search" />
         </div>
         <div className="header_right">
            <IconButton>
               <AppsIcon />
            </IconButton>
            <IconButton>
               <Avatar src="" />
            </IconButton>
         </div>
      </div>
   );
}

export default Header;
