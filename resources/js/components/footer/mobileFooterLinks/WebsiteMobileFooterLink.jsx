import { Link, router } from "@inertiajs/react";
import { useState } from "react";

const WebsiteMobileFooterLink = ({ to = "/", onClick, children }) => {
    const [isHovered, setIsHovered] = useState(false);

    return (
        <Link
            onClick={onClick}
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
            className={`w-[150px] flex justify-start content-start items-center flex-wrap  gap-[10px]  py-[10px] px-[22px] text-sm font-normal  border-l border-[#ECECEC] transition-all duration-400 ease-in-out 
  ${
      router.page?.url === to
          ? "text-primary-500 font-medium "
          : "text-Gray-scale-02 hover:text-primary-500 hover:font-medium "
  }`}
            to={to}
        >
            {(router.page?.url === to || isHovered) && (
                <span className="w-[6px] h-[6px] rounded-full bg-primary-500 transition-transform duration-400 ease-in-out scale-100"></span>
            )}
            {children}
        </Link>
    );
};

export default WebsiteMobileFooterLink;
