import React from "react";
import Header from "../../partials/Header";

const Layout = ({ children, menu = "", submenu = "" }) => {
  return (
    <>
      {/* HEADER */}
      <Header menu={menu} submenu={submenu} />

      {/* NAVIGATION */}

      {/* BODY */}
      {children}

      {/* FOOTER */}
    </>
  );
};

export default Layout;
