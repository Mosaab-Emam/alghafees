import { useState } from "react";

// import MenuIcon from "@/Components/MenuIcon";
import WebsiteLink from "@/Components/WebsiteLink";

const nestedLinks = [
    { id: 1, name: "المدونة", to: "/blog" },
    { id: 2, name: "تواصل معنا", to: "/contact-us" },
];

const DropdownButton = () => {
    const [isHovered, setIsHovered] = useState(false);
    const [isOpen, setIsOpen] = useState(false);

    const handleClick = () => {
        setIsOpen(!isOpen);
    };

    return (
        <button
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
            onClick={handleClick}
            className={`relative cursor-pointer w-full h-full flex justify-center items-center text-sm font-normal border border-[#ECECEC] text-Gray-scale-02 `}
        >
            {/* <MenuIcon /> */}

            {(isHovered || isOpen) && (
                <div className="absolute -bottom-[76px] -left-8 border border-primary-600 bg-white w-[105px]  z-20">
                    {/* Add the arrow element */}
                    <div className="absolute -top-2 left-[78%] transform -translate-x-1/2 w-4 h-4 bg-white border-t border-r border-primary-600 rotate-[-45deg]"></div>

                    {nestedLinks.map((link) => (
                        <WebsiteLink
                            onClick={handleClick}
                            key={link.id}
                            to={link.to}
                        >
                            {link.name}
                        </WebsiteLink>
                    ))}
                </div>
            )}
        </button>
    );
};

export default DropdownButton;
