import logo from '../assets/Front-end/resources/image/logo.png'
import account from '../assets/Front-end/resources/image/account.png'
import home from '../assets/Front-end/resources/image/home.png'
import category from '../assets/Front-end/resources/image/category.png'
import history from '../assets/Front-end/resources/image/history.png'
import wishlist from '../assets/Front-end/resources/image/wishlist.png'
import './Header.css'

function Header() {

    return (
    <header>
        <div id="header">
            <img src={logo} id="logo" />
            <a href="/Front-end/Login/login.html">
                <img src={account} className="accountIcon" />
            </a>
        </div>
        <div id="nav">
            <div className="navSection">
                <a href="home.html">
                    <div className="navTab">
                        <img src={home} />
                        <p id="selectedTab">HOME</p>
                    </div>
                </a>
                <a href="">
                    <div className="navTab">
                        <img src={category} />
                        <p>SHOP BY <b>CATEGORY</b></p>
                    </div>
                </a>
            </div>
            <div className="navSection">
                <a href="">
                    <div className="navTab">
                        <img src={history} />
                        <p>HISTORY</p>
                    </div>
                </a>
                <a href="">
                    <div className="navTab">
                        <img src={wishlist} />
                        <p>WISHLIST</p>
                    </div>
                </a>
            </div>
        </div>
    </header>
    )
}

export default Header