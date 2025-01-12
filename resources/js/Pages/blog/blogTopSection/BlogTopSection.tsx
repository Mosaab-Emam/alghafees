import BlogCategories from "../blogCategories/BlogCategories";
import BlogTitleBox from "./BlogTitleBox";
import SearchInBlog from "./SearchInBlog";

export default function BlogTopSection() {
    return (
        <section className="flex md:flex-row flex-col md:mb-0 mb-[50px] gap-[50px]">
            <div className="md:w-[692px] w-[360px] flex flex-col self-center items-start md:gap-16 gap-8">
                <BlogTitleBox />
                <SearchInBlog autoSearch={true} />
            </div>
            <BlogCategories />
        </section>
    );
}
