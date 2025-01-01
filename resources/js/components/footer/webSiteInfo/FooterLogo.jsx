import React from "react";
import ParagraphContent from "../../ParagraphContent";
import { FooterLogoSvg } from "../../../assets/images/footer";

const FooterLogo = () => {
	return (
		<div className='flex flex-col items-start gap-6 md:w-[221px] w-[312px]'>
			<FooterLogoSvg className='lg:w-[122px] xl:w-[129px] w-[85px] lg:h-[120px] xl:h-[166px] h-[109.38px]' />
			<ParagraphContent>
				تفخر شركة صالح علي الغفيص للتقييم العقاري بفروعها المرخصة في مزاولة مهنة
				التقييم العقاري في كل من الرياض والقصيم.
			</ParagraphContent>
		</div>
	);
};

export default FooterLogo;
