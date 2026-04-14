import React, { useState } from "react";
import { FaChevronDown } from "react-icons/fa";
import { Link } from "react-router-dom";

const NavigationAccordions = ({ item, subNavList = [] }) => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <>
      <button
        onClick={() => setIsOpen((prev) => !prev)}
        className="w-full px-4 py-2 uppercase flex items-center justify-between gap-2 hover:bg-gray-50/10 transition"
      >
        <div className="flex items-center gap-2">
          {item?.icon}
          <span>{item?.label}</span>
        </div>

        <FaChevronDown
          className={`transition-transform duration-200 ${
            isOpen ? "rotate-180" : ""
          }`}
        />
      </button>

      {isOpen && (
        <ul className="w-full self-start">
          {subNavList.map((item, key) => (
            <li key={key} className="w-full">
              <Link
                to={item.path}
                className="w-full block  pl-10 py-1 hover:bg-gray-50/10 transition"
              >
                {item.label}
              </Link>
            </li>
          ))}
        </ul>
      )}
    </>
  );
};

export default NavigationAccordions;
