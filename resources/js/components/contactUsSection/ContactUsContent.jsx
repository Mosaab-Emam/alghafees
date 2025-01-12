import React from "react";
import SectionTitle from "../SectionTitle";
import TextContent from "../TextContent";

const ContactUsContent = ({
	showPriceOffer,
	contactUsContentPosition = "mt-[132px] mb-0",
}) => {
	return showPriceOffer ? (
		<TextContent textColor={"text-Black-01"}>
			نحن هنا <span className='text-primary-600'>لمساعدتك</span> <br />
			تواصل معنا الآن
		</TextContent>
	) : (
		<div
			className={`${contactUsContentPosition} flex flex-col items-start  md:mb-[92px]  md:mt-[364px] gap-4 self-stretch`}>
			<SectionTitle textColor={"text-primary-600"} title={"تواصل معنا"} />
			<TextContent textColor={"text-Black-01"}>
				نحن هنا <span className='text-primary-600'>لمساعدتك</span> <br />
				تواصل معنا الآن
			</TextContent>
		</div>
	);
};

export default ContactUsContent;
