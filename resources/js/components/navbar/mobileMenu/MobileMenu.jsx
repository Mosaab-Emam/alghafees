import React, { useEffect } from "react";
import ButtonsBox from "../../ButtonsBox";
import WebsiteLink from "../WebsiteLink";
import MenuButton from "./MenuButton";

const links = [
    { id: 1, name: "الرئيسية", to: "/" },
    { id: 2, name: "من نحن", to: "/about-us" },
    { id: 3, name: "خدماتنا", to: "/our-services" },
    { id: 4, name: "عملاؤنا", to: "/our-clients" },
    { id: 5, name: "الفعاليات", to: "/events" },
    { id: 6, name: "طلب تقييم ", to: "/request-evaluation" },
    { id: 7, name: "المدونة", to: "/blog" },
    { id: 8, name: "تواصل معنا", to: "/contact-us" },
];

const MobileMenu = ({ onClickMenu, toggleMobileMenu }) => {
    useEffect(() => {
        if (toggleMobileMenu) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "unset";
        }

        return () => {
            document.body.style.overflow = "unset";
        };
    }, [toggleMobileMenu]);

    return (
        <div
            className={`fixed z-50 ${
                toggleMobileMenu ? "translate-x-0 left-0" : "-translate-x-full"
            } top-0 w-full md:hidden flex flex-col justify-between items-start gap-[10px] p-6 bg-bg-01 rounded-tl-[50px] rounded-br-[50px] shadow-[0px_12px_35px_0px_rgba(15,129,159,0.16)] transition-transform duration-700 ease-in-out`}
        >
            <div className="flex flex-col  items-start self-stretch gap-4">
                <div className="flex justify-start items-start gap-[10px] pb-6">
                    <MenuButton onClickMenu={onClickMenu} />
                </div>
                {links.map((link) => (
                    <WebsiteLink
                        onClick={onClickMenu}
                        key={link.id}
                        to={link.to}
                    >
                        {link.name}
                    </WebsiteLink>
                ))}
                <ButtonsBox
                    gap="gap-4"
                    outLinButtonOnClick={() =>
                        (window.location.href = "/track-your-request")
                    }
                    primaryButtonOnClick={() =>
                        (window.location.href = "/join-us")
                    }
                    outlineBtnContent={"تتبع طلبك "}
                    primaryBtnContent={"انضم إلينا"}
                />
            </div>
        </div>
    );
};

export default MobileMenu;
