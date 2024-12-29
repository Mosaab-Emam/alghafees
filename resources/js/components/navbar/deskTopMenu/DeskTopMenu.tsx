import React from "react";
import WebsiteLinks from "../WebsiteLinks";
import ButtonsBox from "../../ButtonsBox";
import { useNavigate } from "react-router-dom";

const links = [
	{ id: 1, name: "الرئيسية", to: "/" },
	{ id: 2, name: "من نحن", to: "/about-us" },
	{ id: 3, name: "خدماتنا", to: "/our-services" },
	{ id: 4, name: "عملاؤنا", to: "/our-clients" },
	{ id: 5, name: "الفعاليات", to: "/events" },
	{ id: 6, name: "طلب تقييم ", to: "/request-evaluation" },
];

const DesktopMenu = () => {
	const navigate = useNavigate();
	return (
		<div className='w-full md:flex justify-between hidden'>
			<WebsiteLinks links={links} />

			<ButtonsBox
				outLinButtonOnClick={() => navigate("/track-your-request")}
				primaryButtonOnClick={() => navigate("/join-us")}
				outlineBtnContent={"تتبع طلبك "}
				primaryBtnContent={"انضم إلينا"}
			/>
		</div>
	);
};

export default DesktopMenu;
