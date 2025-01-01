import React from "react";

// components
import AboutGoals from "./AboutGoals";
import ButtonsBox from "../ButtonsBox";

// icons
import { DownloadIcon } from "../../assets/icons";

// data
import { aboutData } from "../../data";
import { useNavigate } from "react-router-dom";
import { samplePdf } from "../../assets/pdf-docs";

const LeftContent = () => {
	const navigate = useNavigate();

	const handleDownload = () => {
		const link = document.createElement("a");

		link.href = samplePdf;
		link.download = `${"تقرير السوق العقاري 2024"}.pdf`;
		link.click();
	};

	return (
		<section className='flex flex-col justify-start md:self-end self-start items-start w-full lg:w-[387px] overflow-hidden'>
			{aboutData.map((item, index) => (
				<AboutGoals
					index={index}
					key={item.id}
					img={item.img}
					title={item.title}
					desc={item.desc}
				/>
			))}

			<ButtonsBox
				radius={"left"}
				btnWidth='w-full lg:w-full xl:w-[387px] '
				gap={"gap-[10px]"}
				flexDirection={"flex-col-reverse"}
				icon={<DownloadIcon />}
				outlineBtnContent={"عرض المزيد من التقارير المعتمدة"}
				primaryBtnContent={"تحميل تقرير السوق العقاري 2024"}
				primaryButtonOnClick={handleDownload}
				outLinButtonOnClick={() => {
					navigate("/about-us");
				}}
			/>
		</section>
	);
};

export default LeftContent;
