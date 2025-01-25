import NewsLetterForm from "./NewsLetterForm";
import NewsLetterTextBox from "./NewsLetterTextBox";

const NewLetter = ({ className }) => {
    return (
        <section
            className={`${className} flex-col items-start lg:w-[550px] xl:w-[793px] w-[90%] gap-8 z-10 lg:mr-[460px] xl:mr-[527px] mr-[20px] lg:top-[8.9rem] relative  lg:mb-[220px] mb-[8rem]`}
        >
            <NewsLetterTextBox />
            <NewsLetterForm />
        </section>
    );
};

export default NewLetter;
