import React from "react";
import SectionTitle from "../SectionTitle";
import TextContent from "../TextContent";
import ParagraphContent from "../ParagraphContent";

const RightContent = () => {
	return (
		<section className='flex flex-col md:mt-[80px] -mt-[190px] items-start gap-4 w-full  lg:w-[290px] xl:w-[285px] '>
			<SectionTitle title={"من نحن"} />
			<TextContent>
				تعرّف على <span className='text-primary-600'>فريقنا</span> الخبير ذو
				الخبرة لتقديم أفضل الحلول العقارية
			</TextContent>

			<ParagraphContent>
				تأسست شركة صالح علي الغفيص للتقييم والتثمين العقاري سنة 2015م بمنطقة
				القصيم بمدينة بريدة ويحمل سجل تجاري رقم )1131056566( ، ثم التوسع ليتم
				افتتاح مكتب الرياض سنة 2021م بسجل تجاري رقم )1010721458( وتغطي أعمال
				الشركة كافة مناطق المملكة .
			</ParagraphContent>
		</section>
	);
};

export default RightContent;
