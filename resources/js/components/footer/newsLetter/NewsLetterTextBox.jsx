import React from "react";
import SectionTitle from "../../SectionTitle";
import TextContent from "../../TextContent";
import ParagraphContent from "../../ParagraphContent";

const NewsLetterTextBox = () => {
	return (
		<div className=''>
			<div className='flex flex-col items-start gap-4 self-stretch mb-2'>
				<SectionTitle
					textColor={"text-primary-600"}
					title={"النشرة الاخبارية"}
				/>
				<TextContent textColor={"text-Black-01"}>
					ابقَ على اطلاع دائم بأحدث المستجدات العقارية
				</TextContent>
			</div>
			<ParagraphContent>
				اشترك في نشرتنا الإخبارية لتصلك آخر الأخبار، والنصائح، والتحليلات حول
				السوق العقاري. كن أول من يعرف عن الفرص الاستثمارية والعروض الحصرية
			</ParagraphContent>
		</div>
	);
};

export default NewsLetterTextBox;
