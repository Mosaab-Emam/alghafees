import React from "react";
import Button from "../../button/Button";
import DownloadIconSVG from "../../shapes/DownloadIconSVG";

const DownloadReportButton = ({ title, type, radius, file }) => {
	const handleDownload = () => {
		const link = document.createElement("a");

		link.href = file;
		link.download = `${title}.pdf`;
		link.click();
	};

	return (
		<Button
			variant={type}
			radius={radius}
			onClick={handleDownload}
			className='sm:h-[48px] lg:h-[46px] xl:h-[48px] xl:w-[370px] lg:w-full w-full'>
			<DownloadIconSVG type={type} />
			{title}
		</Button>
	);
};

export default DownloadReportButton;
